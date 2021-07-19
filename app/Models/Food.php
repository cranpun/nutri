<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = "food";

    protected $guarded = [
        "id"
    ];

    public static function validaterule()
    {
        return [
            "name" => "required|string",
            "category" => "required|in:" . join(",", array_keys((new \App\L\FoodCategory())->labels())),
            "favorite" => "required|in:0,100",
        ];
    }
}
