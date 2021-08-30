<?php
namespace App\Http\Controllers\Admin\Food;

trait FoodTraitUpdate
{
    public function update(\Illuminate\Http\Request $request, string $food_id) : \Illuminate\View\View
    {
        $row = \App\Models\Food::where("id", "=", $food_id)->first();
        $nutris = \App\Models\Nutri::loadAll();
        $foodnutris = $this->update_loadNutri($food_id);
        $category = (new \App\L\FoodCategory())->labelObjs();
        return view("admin.food.update.main", compact(["row", "nutris", "category", "foodnutris"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function update_loadNutri(string $food_id) : array
    {
        $q = \App\Models\Foodnutri::query();
        $q->where("foodnutri.food_id", "=", $food_id);
        $q->select([
            "foodnutri.nutri_id AS id",
        ]);
        $rows = $q->get();

        $ret = [];
        foreach($rows as $row) {
            $ret[] = $row->id;
        }

        return $ret;
    }
}