<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menufood extends Model
{
    use HasFactory;

    protected $table = "menufood";

    static $VALIDATE = [

    ];
    static $guarded = [
        "id"
    ];
}
