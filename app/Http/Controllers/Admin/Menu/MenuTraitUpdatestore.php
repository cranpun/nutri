<?php

namespace App\Http\Controllers\Admin\Menu;

use Illuminate\Http\Request;

trait MenuTraitUpdatestore
{
    public function updatestore(\Illuminate\Http\Request $request, $servedate, $timing)
    {
        // 複数回の変更があるためtransaction
        $trans = \DB::transaction(function () use ($request, $servedate, $timing) {
            $data = $request->all();
            $names = array_key_exists("name", $data) ? $data["name"] : [];
            $menufoods = array_key_exists("menufood", $data) ? $data["menufood"] : [];

            // 日付とタイミングの検証
            $val = \App\Models\Menu::validaterule();
            $val_common = [
                "servedate" => $val["servedate"],
                "timing" => $val["timing"]
            ];
            \Validator::make(compact(["servedate", "timing"]), $val_common)->validate();

            $menu_ids = $this->updatestore_procMenu($servedate, $timing, $names);
            $this->updatestore_procMenufood($menu_ids, $menufoods);

            return true;
        });

        if ($trans) {
            $srch = $this->index_srch($request); // ※indexの関数。trait外呼び出しなので注意。
            return redirect()->route("admin-menu-index", $srch)->with("message-success", "更新しました。");
        } else {
            \U::invokeErrorValidate($request, "保存に失敗しました。{$trans->message()}");
        }
    }

    // *************************************
    // utils : 衝突を避けるため、action名_メソッド名とすること
    // *************************************
    private function updatestore_procMenu($servedate, $timing, $names): array
    {
        // まずは該当するメニューを保持。menufoodクリアのため。
        $q_old = \App\Models\Menu::query();
        $q_old->where("servedate", "=", $servedate);
        $q_old->where("timing", "=", $timing);
        $rows_old = $q_old->get();
        $oldids = [];
        foreach ($rows_old as $row) {
            $oldids[] = $row->id;
        }

        // 現在の登録内容をクリア
        $q_old->delete();

        // 新しく保存
        $newids = [];
        $val = \App\Models\Menu::validaterule();
        // servedateとtimingは呼び出し元で検証済み
        $val_now = [
            "name" => $val["name"],
        ];
        foreach ($names as $idx => $name) {
            if ($name && strlen($name) > 0) {
                $ent = new \App\Models\Menu();
                // amountは未使用なので0固定。
                \validator::make(["name" => $name], $val_now)->validate();
                $ent->name = $name;
                $ent->servedate = $servedate;
                $ent->timing = $timing;
                $ent->save();
                $newids[] = $ent->id;
            }
        }

        return compact(["newids", "oldids"]);
    }

    private function updatestore_procMenufood($menu_ids, $menufoods)
    {
        // まずはmenu_ids["oldids"]に従って古いfoodmenuを削除
        \App\Models\Menufood::whereIn("menu_id", $menu_ids["oldids"])->delete();

        if (count($menu_ids["newids"]) <= 0) {
            // 新しい献立がないためポストされた食材は全て破棄
            return;
        }

        // 新しいmenu_ids["newids"]に従って新しいfoodmenuを登録。food_idsはuiのidx配列で保存されているのでそれを踏まえること。
        foreach ($menufoods as $idx => $menufood_ids) {
            if (array_key_exists($idx, $menu_ids["newids"]) && strlen($menu_ids["newids"][$idx]) > 0) {
                $menu_id = $menu_ids["newids"][$idx];
                foreach ($menufood_ids as $food_id => $on) {
                    $ent = new \App\Models\Menufood();
                    $ent->food_id = $food_id;
                    $ent->menu_id = $menu_id;
                    $ent->amount = 0; // amountは未使用なので0固定
                    $ent->save();
                }
            }
        }
    }
}
