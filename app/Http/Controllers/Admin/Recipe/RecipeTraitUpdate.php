<?php
namespace App\Http\Controllers\Admin\Recipe;

trait RecipeTraitUpdate
{
    public function update(\Illuminate\Http\Request $request, $recipe_id)
    {
        $row = \App\Models\Recipe::where("id", "=", $recipe_id)->first();
        $category = (new \App\L\RecipeCategory())->labelObjs();
        return view("admin.recipe.update.main", compact(["row", "category"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
}