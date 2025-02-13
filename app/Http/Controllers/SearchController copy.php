<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class Controller extends Controller
{
    public function index(Request $request)
    {
        $query = Player::query();

        if ($request->filled('first_name')) {
            $query->where('first_name', 'LIKE', '%' . $request->input('first_name') . '%');
        }

        if ($request->filled('last_name')) {
            $query->where('last_name', 'LIKE', '%' . $request->input('last_name') . '%');
        }

        if ($request->filled('position')) {
            $query->where('position', 'LIKE', '%' . $request->input('position') . '%');
        }

        if ($request->filled('age_min')) {
            $query->where('age', '>=', $request->input('age_min'));
        }

        if ($request->filled('age_max')) {
            $query->where('age', '<=', $request->input('age_max'));
        }

        if ($request->filled('nationality')) {
            $query->where('nationality', 'LIKE', '%' . $request->input('nationality') . '%');
        }

        if ($request->filled('passport')) {
            $query->where('passport', 'LIKE', '%' . $request->input('passport') . '%');
        }

        $players = $query->get();

        return view('search.index', compact('players'));
    }
}
