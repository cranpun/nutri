<?php
namespace App\Http\Controllers\Admin\Food;

use Illuminate\Http\Request;

trait FoodTraitShoppingnote
{
    public static $shoppingnote_NAME_FOOD_ID = "food_id";

    public function shoppingnote(Request $request)
    {
        $sdate = \Carbon\Carbon::today()->format("Y-m-d"); // 開始日：本日
        $edate = \Carbon\Carbon::today()->add(config("myconf.shoppingnoterange"), "day")->format("Y-m-d"); // 2週間先
        $rows = $this->shoppingnote_load($sdate, $edate);
        $food_ids = $this->shoppingnote_postfoodids($request);
        return view("admin.food.shoppingnote.main", compact(["rows", "sdate", "edate", "food_ids"]));
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
        $q->select([
            "menu.name AS menu_name",
            "menu.servedate AS menu_servedate",
            "food.id AS food_id",
            "food.name AS food_name",
            \DB::raw((new \App\L\FoodCategory())->sqlCase("food.category", "food_category")),
        ]);
        $q->orderBy("food.category", "ASC");
        $q->orderBy("menu.servedate", "ASC");

        $rows = $q->get();
        $ret = [];
        foreach($rows as $row) {
            if(!array_key_exists($row->food_id, $ret)) {
                // 初期化
                $ret[$row->food_id] = [
                    "food_id" => $row->food_id,
                    "food_name" => $row->food_name,
                    "food_category" => $row->food_category,
                    "menus" => [],
                ];
            }
            $ret[$row->food_id]["menus"][] = $row;
        }

        return $ret;
    }

    private function shoppingnote_postfoodids($request)
    {
        $data = $request->query(self::$shoppingnote_NAME_FOOD_ID, []);
        $ret = array_keys($data);
        return $ret;
    }
}