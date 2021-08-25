<?php
namespace App\Http\Controllers\Admin\Recipe;

use Illuminate\Http\Request;

trait RecipeTraitIndex
{
    public function index(Request $request)
    {
        $q = \App\Models\Recipe::query();
        $q->select([
            "recipe.id AS id",
            "recipe.name AS name",
            \DB::raw((new \App\L\RecipeCategory())->sqlCase("recipe.category", "category")),
            "recipe.url AS url",
            "recipe.memo AS memo",
        ]);
        $q->orderBy("recipe.category", "ASC");
        $rows = $q->get();
        $category = (new \App\L\RecipeCategory())->labelObjs();
        return view("admin.recipe.index.main", compact(["rows", "category"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
}