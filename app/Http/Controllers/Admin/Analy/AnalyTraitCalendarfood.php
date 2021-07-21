<?php
namespace App\Http\Controllers\Admin\Analy;

use Illuminate\Http\Request;

trait AnalyTraitCalendarfood
{
    public function createstore(\Illuminate\Http\Request $request)
    {
        $data = $request->all();
        $id = array_key_exists("id", $data) ? $data["id"] : null;

        $row = new \App\Models\Food();
        $data = $request->all();
        $valorg = \App\Models\Food::validaterule();
        $val = [
            "name" => $valorg["name"],
        ];
        \Validator::make($data, $val)->validate();

        $row->name = $data["name"];
        $row->category = \App\L\FoodCategory::ID_ETC;
        $row->favorite = 100;

        if(!$row->save()) {
            // 保存失敗
            \U::invokeErrorValidate($request, "更新に失敗しました。");
        }
        return redirect()->route("admin-food-update", ["food_id" => $row->id])->with("message-success", "更新しました。続けて他の情報を登録してください。");
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
}
