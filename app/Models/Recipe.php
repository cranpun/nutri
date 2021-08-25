<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $table = "recipe";

    protected $guarded = [
        "id"
    ];

    public static function validaterule()
    {
        return [
            "name" => "required|string",
            "category" => "required|string",
            "url" => "nullable|string",
            "memo" => "nullable|string",
        ];
    }
}
