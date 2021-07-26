<?php
namespace App\Http\Controllers\Admin\Food;

use Illuminate\Http\Request;

trait FoodTraitShoppingnote
{
    public function shoppingnote(Request $request)
    {
        $sdate = \Carbon\Carbon::today()->format("Y-m-d"); // 開始日：本日
        $edate = \Carbon\Carbon::today()->add(config("myconf.shoppingnoterange"), "day")->format("Y-m-d"); // 2週間先
        $rows = $this->shoppingnote_load($sdate, $edate);
        return view("admin.food.shoppingnote.main", compact(["rows", "sdate", "edate"]));
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function shoppingnote_load($sdate, $edate)
    {
        $q = \App\Models\Menufood::query();
        $q->join("menu", "menu.id", "=", "menufood.menu_id");
        $q->join("food", "food.id", "=", "menufood.food_id");
        $q->whereBetween("menu.servedate", [$sdate, $edate]);
        $q->groupBy(["food.id", "food.name", "food.category"]);
        $q->select([
            "food.id AS id",
            "food.name AS name",
            \DB::raw((new \App\L\FoodCategory())->sqlCase("food.category", "category")),
            \DB::raw("count(food.id) AS count"),
        ]);
        $q->orderBy("food.category", "ASC");
        $ret = $q->get();
        return $ret;
    }
}