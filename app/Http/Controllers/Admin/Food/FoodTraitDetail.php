<?php
namespace App\Http\Controllers\Admin\Food;

trait FoodTraitDetail
{
    public function detail(\Illuminate\Http\Request $request, string $food_id) : \Illuminate\View\View
    {
        $row = \App\Models\Food::where("id", "=", $food_id)
            ->select([
                "food.*",
                \DB::raw((new \App\L\FoodCategory())->sqlCase("food.category", "foodcategory"))
            ])
            ->first();
        $foodnutris = $this->detail_loadNutri($food_id);
        $menus = $this->detail_loadMenus($food_id);
        return view("admin.food.detail.main", compact(["row", "foodnutris", "menus"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function detail_loadNutri(string $food_id) : array
    {
        $q = \App\Models\Foodnutri::query();
        $q->where("foodnutri.food_id", "=", $food_id);
        $q->join("nutri", "nutri.id", "=", "foodnutri.nutri_id");
        $q->select([
            "foodnutri.*",
            "nutri.name AS nutri_name",
        ]);
        $ret = $q->get();

        return $ret->toArray();
    }

    private function detail_loadMenus(string $food_id) : array
    {
        $q = \App\Models\Menufood::query();
        $q->join("menu", "menu.id", "=", "menufood.menu_id");
        $q->leftJoin("recipe", "recipe.id", "=", "menu.recipe_id");
        $q->where("menufood.food_id", "=", $food_id);
        $q->select([
            "menu.*",
            "recipe.name AS recipe_name",
            "recipe.url AS recipe_url",
            "recipe.memo AS recipe_memo",
        ]);
        $q->orderBy("menu.servedate", "DESC");
        $ret = $q->get();

        return $ret->toArray();
    }
}