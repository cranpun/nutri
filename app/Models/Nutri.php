<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutori extends Model
{
    use HasFactory;

    protected $table = "nutri";

    static $VALIDATE = [

    ];
    static $guarded = [
        "id"
    ];
}
