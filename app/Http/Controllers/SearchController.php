<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view("search.index");
    }

    public function search(Request $request)
    {
        $keyword = $request->input("keyword");
        $items = Player::where("name", "like", "%{keyword}%")
            ->get();

        return view("serch.results", compact("items"));
    }
}
