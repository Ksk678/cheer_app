<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Player extends Model
{
    protected $fillable = [
        "first_name",
        "last_name",
        "position",
        "age",
        "dob",
        "height",
        "weight",
        "nationality",
        "passport",

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function  getImageUrlAttribut()
    {
        return Storage::url("images/players/" . $this->image);
    }
}
