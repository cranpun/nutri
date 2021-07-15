<?php
namespace App\Http\Controllers\Admin\Food;

trait FoodTraitUpdate
{
    public function update(\Illuminate\Http\Request $request, $Food_id)
    {
        $row = \App\Models\Food::where("id", "=", $Food_id)->first();
        return view("admin.food.update.main", compact(["row"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
}