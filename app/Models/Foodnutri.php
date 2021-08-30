<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foodnutri extends Model
{
    use HasFactory;

    protected $table = "foodnutri";

    protected $guarded = [
        "id"
    ];

    public static function validaterule() : array
    {
        return [
            "food_id" => "required|numeric",
            "nutri_id" => "required|numeric",
            "amaount" => "numeric",
        ];
    }
}
