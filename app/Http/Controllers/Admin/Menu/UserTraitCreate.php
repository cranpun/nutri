<?php
namespace App\Http\Controllers\Admin\User;

trait UserTraitCreate
{
    public function create()
    {
        return view("admin.user.create");
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
}