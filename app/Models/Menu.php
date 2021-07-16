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

    public static function validaterule()
    {
        return [
            "name" => "required|string",
            "servedate" => "required|date",
            "timing" => "required|in:" . join(",", array_keys((new \App\L\MenuTiming())->labels())),
        ];
    }
}
