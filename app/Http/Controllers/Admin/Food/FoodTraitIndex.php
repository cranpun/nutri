<?php
namespace App\Http\Controllers\Admin\Food;

use Illuminate\Http\Request;

trait FoodTraitIndex
{
    public function index(Request $request) : \Illuminate\View\View
    {
        $q = \App\Models\Food::query();
        $q->select([
            "food.id AS id",
            "food.name AS name",
            "food.kana AS kana",
            "food.favorite AS favorite",
            "food.category AS category",
        ]);
        $q->orderBy("food.kana", "ASC");
        $raws = $q->get();
        $rows = $this->index_make($raws);
        return view("admin.food.index.main", compact(["rows"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************

    private function index_make(\Illuminate\Support\Collection $rows) : array
    {
        $ret = [];
        foreach($rows as $row) {
            $row["nutri"] = $this->index_loadNutri($row->id);
            $row["bgcolor"] = $this->index_favoritecolor($row->favorite);
            $ret[] = $row;
        }
        return $ret;
    }

    private function index_loadNutri(int $food_id) : array
    {
        $q = \App\Models\Foodnutri::query();
        $q->join("nutri", "nutri.id", "foodnutri.nutri_id");
        $q->where("foodnutri.food_id", "=", $food_id);
        $q->orderBy("nutri.pos", "ASC");
        $q->select([
            "nutri.id AS id",
            "nutri.name AS name",
        ]);
        $rows = $q->get();

        $ret = [];
        foreach($rows as $row) {
            $ret[$row->id] = $row["name"];
        }
        return $ret;
    }

    private function index_favoritecolor(int $fav) : string
    {
        $colors = [
            0 => "has-background-primary-light favorite",
        ];
        if(array_key_exists($fav, $colors)) {
            return $colors[$fav];
        } else {
            return "";
        }
    }
}