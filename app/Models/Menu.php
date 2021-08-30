<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = "menu";

    protected $guarded = [
        "id"
    ];

    public static function validaterule() : array
    {
        return [
            "name" => "required|string",
            "memo" => "string",
            "servedate" => "required|date",
            "timing" => "required|in:" . join(",", array_keys((new \App\L\MenuTiming())->labels())),
        ];
    }
}
