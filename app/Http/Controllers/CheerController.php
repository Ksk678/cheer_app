<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCheerRequest;
use App\Http\Requests\UpdateCheerRequest;
use App\Models\Cheer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CheerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cheers = Cheer::latest()->paginate(12);

        return view("cheers.index", compact("cheers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("cheers.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCheerRequest $request)
    {
        $cheer = new Cheer($request->all());
        $cheer->user_id = $request->user()->id;

        $imageFile = $request->file("image");
        $cheer->image = self::createFileName($imageFile);

        $highlightFile = $request->file("highlight");
        $cheer->highlight = self::createFileName($highlightFile);

        // トランザクション開始
        DB::beginTransaction();
        try {
            // 登録
            $cheer->save();

            // 画像アップロード
            if (!Storage::putFileAs('/images/cheers', $imageFile, $cheer->image)) {
                // 例外を投げてロールバックさせる
                throw new \Exception('画像ファイルの保存に失敗しました。');
            }

            if (!Storage::putFileAs('/videos/cheers', $highlightFile, $cheer->highlight)) {
                throw new \Exception('動画ファイルの保存に失敗しました。');
            }

            // トランザクション終了(成功)
            DB::commit();
        } catch (\Exception $e) {
            // トランザクション終了(失敗)
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return redirect()
            ->route('cheers.show', $cheer)
            ->with('notice', '記事を登録しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cheer = Cheer::find($id);

        return view("cheers.show", compact("cheer"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cheer = Cheer::find($id);

        return view("cheers.edit", compact("cheer"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCheerRequest $request, string $id)
    {
        $cheer = Cheer::find($id);

        if ($request->user()->cannot('update', $cheer)) {
            return redirect()->route('cheers.show', $cheer)
                ->withErrors('自分の記事以外は更新できません');
        }

        $imageFile = $request->file('image');
        if ($imageFile) {
            $delete_image_path = 'images/cheers/' . $cheer->image;
            $cheer->image = self::createFileName($imageFile);
        }

        $highlightFile = $request->file('highlight');
        if ($highlightFile) {
            $delete_highlight_path = 'videos/cheers/' . $cheer->highlight;
            $cheer->highlight = self::createFileName($highlightFile);
        }


        $cheer->fill($request->all());

        DB::beginTransaction();
        try {
            $cheer->save();

            if ($imageFile) {
                if (!Storage::putFileAs('images/cheers', $imageFile, $cheer->image)) {
                    throw new \Exception('画像ファイルの保存に失敗しました。');
                }
                if (!Storage::delete($delete_image_path)) {
                    Storage::delete('images/cheers/' . $cheer->image);
                    throw new \Exception('画像ファイルの削除に失敗しました。');
                }
            }

            if ($highlightFile) {
                if (!Storage::putFileAs('videos/cheers/', $highlightFile, $cheer->highlight)) {
                    throw new \Exception('動画ファイルの保存に失敗しました。');
                }
                if (!Storage::delete($delete_highlight_path)) {
                    Storage::delete('videos/cheers/' . $cheer->highlight);
                    throw new \Exception('動画ファイルの削除に失敗しました。');
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return redirect()->route('cheers.show', $cheer)
            ->with('notice', 'Your profile has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cheer = Cheer::find($id);

        DB::beginTransaction();
        try {
            $cheer->delete();

            if (!Storage::delete('images/cheers/' . $cheer->image)) {
                throw new \Exception('画像ファイルの削除に失敗しました。');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors($e->getMessage());
        }

        return redirect()->route('cheers.index')
            ->with('notice', 'Your profile has deleted');
    }


    private static function createFileName($file)
    {
        return date('YmdHis') . '_' . $file->getClientOriginalName();
    }
}
