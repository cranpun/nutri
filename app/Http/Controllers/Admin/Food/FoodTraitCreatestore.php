<?php
namespace App\Http\Controllers\Admin\Food;

use Illuminate\Http\Request;

trait FoodTraitCreatestore
{
    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->all();
        $id = array_key_exists("id", $data) ? $data["id"] : null;

        if($id) {
            // update
            $row = \App\Models\Food::where("id", "=", $id)->first();
            // ユーザ名が同じであればuniqueは外す
            $val = \App\Models\Food::$VRULES;
            if($row["name"] == $data["name"]) {
                $val["name"] = "required";
            }
            unset($val["password"]); // updateのときはpasswordとroleのチェックは不要
            unset($val["role"]);
            $request->validate($val);
        } else {
            $row = new \App\Models\Food();
            $data = $request->all();
            $data["role"] = \App\L\Role::ID_ADMIN; // roleは固定
            \Validator::make($data, \App\Models\Food::$VRULES);
        }
        if(!$row->saveProc($data)) {
            // 保存失敗
            \U::invokeErrorValidate($request, "更新に失敗しました。");
        }
        return redirect()->route("admin-Food-index")->with("message-success", "更新しました。");
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
}