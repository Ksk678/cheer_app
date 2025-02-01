<?php

namespace App\Http\Controllers;

use App\Models\Cheer;
use Illuminate\Http\Request;

class SeachController extends Controller
{
    public function index()
    {
        return view("search.index");
    }

    public function search(Request $request)
    {
        $keyword = $request->input("keyword");
        $items = Item::where("name", "like", "%{keyword}%")
            ->get();

        return view("serch.results", compact("items"));
    }
}
