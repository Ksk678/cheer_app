<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\Player;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = Player::latest()->paginate(12);

        return view("players.index", compact("players"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("players.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerRequest $request)
    {
        $player = new Player($request->all());
        $player->user_id = $request->user()->id;

        $imageFile = $request->file("image");
        $player->image = self::createFileName($imageFile);

        $highlightFile = $request->file("highlight");
        $player->highlight = self::createFileName($highlightFile);

        // トランザクション開始
        DB::beginTransaction();
        try {
            // 登録
            $player->save();

            // 画像アップロード
            if (!Storage::putFileAs('/images/players', $imageFile, $player->image)) {
                // 例外を投げてロールバックさせる
                throw new \Exception('画像ファイルの保存に失敗しました。');
            }

            if (!Storage::putFileAs('/videos/players', $highlightFile, $player->highlight)) {
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
            ->route('players.show', $player)
            ->with('notice', '記事を登録しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $player = Player::find($id);

        return view("players.show", compact("player"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $player = Player::find($id);

        return view("players.edit", compact("player"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlayerRequest $request, string $id)
    {
        $player = Player::find($id);

        if ($request->user()->cannot('update', $player)) {
            return redirect()->route('players.show', $player)
                ->withErrors('自分の記事以外は更新できません');
        }

        $imageFile = $request->file('image');
        if ($imageFile) {
            $delete_image_path = 'images/players/' . $player->image;
            $player->image = self::createFileName($imageFile);
        }

        $highlightFile = $request->file('highlight');
        if ($highlightFile) {
            $delete_highlight_path = 'videos/players/' . $player->highlight;
            $player->highlight = self::createFileName($highlightFile);
        }


        $player->fill($request->all());

        DB::beginTransaction();
        try {
            $player->save();

            if ($imageFile) {
                if (!Storage::putFileAs('images/players', $imageFile, $player->image)) {
                    throw new \Exception('画像ファイルの保存に失敗しました。');
                }
                if (!Storage::delete($delete_image_path)) {
                    Storage::delete('images/players/' . $player->image);
                    throw new \Exception('画像ファイルの削除に失敗しました。');
                }
            }

            if ($highlightFile) {
                if (!Storage::putFileAs('videos/players/', $highlightFile, $player->highlight)) {
                    throw new \Exception('動画ファイルの保存に失敗しました。');
                }
                if (!Storage::delete($delete_highlight_path)) {
                    Storage::delete('videos/players/' . $player->highlight);
                    throw new \Exception('動画ファイルの削除に失敗しました。');
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return redirect()->route('players.show', $player)
            ->with('notice', 'Your profile has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $player = Player::find($id);

        DB::beginTransaction();
        try {
            $player->delete();

            if (!Storage::delete('images/players/' . $player->image)) {
                throw new \Exception('画像ファイルの削除に失敗しました。');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors($e->getMessage());
        }

        return redirect()->route('players.index')
            ->with('notice', 'Your profile has deleted');
    }


    private static function createFileName($file)
    {
        return date('YmdHis') . '_' . $file->getClientOriginalName();
    }
}
