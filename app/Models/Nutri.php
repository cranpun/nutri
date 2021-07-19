<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutri extends Model
{
    use HasFactory;

    protected $table = "nutri";

    protected $guarded = [
        "id"
    ];

    public static function validaterule()
    {
        return [
            "name" => "required|string",
            "dailyrequired" => "required|numeric",
            "pos" => "required|integer",
        ];
    }

    public static function loadAll()
    {
        $q = \App\Models\Nutri::query();
        $q->orderBy("pos", "ASC");
        $rows = $q->get();
        $ret = [];
        foreach ($rows as $row) {
            $ret[$row->id] = $row;
        }
        return $ret;
    }
}
