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
        $cheers = Cheer::latest()->paginate(4);

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

        $file = $request->file("image");
        $cheer->image = self::createFileName($file);

        // トランザクション開始
        DB::beginTransaction();
        try {
            // 登録
            $cheer->save();

            // 画像アップロード
            if (!Storage::putFileAs('/images/cheeers', $file, $cheer->image)) {
                // 例外を投げてロールバックさせる
                throw new \Exception('画像ファイルの保存に失敗しました。');
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

        $file = $request->file('image');
        if ($file) {
            $delete_file_path = 'images/cheers/' . $cheer->image;
            $cheer->image = self::createFileName($file);
        }
        $cheer->fill($request->all());

        // トランザクション開始
        DB::beginTransaction();
        try {
            // 更新
            $cheer->save();

            if ($file) {
                // 画像アップロード
                if (!Storage::putFileAs('images/cheers', $file, $cheer->image)) {
                    // 例外を投げてロールバックさせる
                    throw new \Exception('画像ファイルの保存に失敗しました。');
                }

                // 画像削除
                if (!Storage::delete($delete_file_path)) {
                    //アップロードした画像を削除する
                    Storage::delete('images/cheers/' . $cheer->image);
                    //例外を投げてロールバックさせる
                    throw new \Exception('画像ファイルの削除に失敗しました。');
                }
            }

            // トランザクション終了(成功)
            DB::commit();
        } catch (\Exception $e) {
            // トランザクション終了(失敗)
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return redirect()->route('cheers.show', $cheer)
            ->with('notice', '記事を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    private static function createFileName($file)
    {
        return date('YmdHis') . '_' . $file->getClientOriginalName();
    }
}
