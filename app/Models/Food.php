<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = "food";
    const categories = "vegetable,meat,seafood,grain(穀物),seasoning（調味料）,etc";

    protected $guarded = [
        "id"
    ];

    public static function validaterule()
    {
        return [
            "name" => "required|string",
            // "category" => "required|in:" . join(",", array_keys((new \App\L\FoodCategory())->labels())),
            "category" => "required|in:" . self::categories,
            "favorite" => "required|in:0,100",
        ];
    }
}
