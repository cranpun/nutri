<?php
namespace App\Http\Controllers\Admin\Recipe;

use Illuminate\Http\Request;

trait RecipeTraitIndex
{
    public static string $index_NAME_CATEGORY = "name-category";
    public function index(Request $request) : \Illuminate\View\View
    {
        $srch = $this->index_srch($request);
        $q = \App\Models\Recipe::query();
        $q->select([
            "recipe.id AS id",
            "recipe.name AS name",
            \DB::raw((new \App\L\RecipeCategory())->sqlCase("recipe.category", "category")),
            "recipe.url AS url",
            "recipe.memo AS memo",
        ]);
        $q->where("recipe.category", "=", $srch[self::$index_NAME_CATEGORY]);
        $q->orderBy("recipe.category", "ASC");
        $rows = $q->get();
        $category = (new \App\L\RecipeCategory())->labelObjs();
        return view("admin.recipe.index.main", compact(["rows", "category", "srch"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function index_srch(Request $request): array
    {
        return [
            self::$index_NAME_CATEGORY => $request->query(self::$index_NAME_CATEGORY, \App\L\RecipeCategory::ID_ETC),
        ];
    }
}