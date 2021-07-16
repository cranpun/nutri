<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menufood extends Model
{
    use HasFactory;

    protected $table = "menufood";

    protected $guarded = [
        "id"
    ];
    public static function validaterule()
    {
        return [
            "menu_id" => "required|integer",
            "food_id" => "required|integer",
            "amaount" => "numeric",
        ];
    }
}
