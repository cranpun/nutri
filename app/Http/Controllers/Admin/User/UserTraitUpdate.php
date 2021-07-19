<?php
namespace App\Http\Controllers\Admin\User;

trait UserTraitUpdate
{
    public function update(\Illuminate\Http\Request $request, $user_id)
    {
        $row = \App\Models\User::where("id", "=", $user_id)->first();
        return view("admin.user.update.main", compact(["row"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
}