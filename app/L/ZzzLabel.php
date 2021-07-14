<?php

namespace App\L;

/**
 * ラベルクラスの基底クラス。名前はソート時に一番下にくるように。
 */
abstract class ZzzLabel
{
    const ID_ALL = "all";

    /**
     * id, nameの連想配列の配列を返す
     */
    abstract public function labels();

    /**
     * コンストラクタで指定されたallの設定に従ってlabel連想配列の配列を返す
     */
    public function labelsAll()
    {
        $ret = array_merge([
            self::ID_ALL => "（全て）"
        ], $this->labels());
        return $ret;
    }

    public function labelObjs()
    {
        $labels = $this->labels();
        foreach($labels as $key => $label) {
            $ret[] = [
                "id" => $key,
                "name" => $label
            ];
        }

        return $ret;
    }
    public function labelObjsAll()
    {
        $labels = $this->labelsAll();
        foreach($labels as $key => $label) {
            $ret[] = [
                "id" => $key,
                "name" => $label
            ];
        }

        return $ret;
    }

    /**
     * sqlのcase節を生成。
     * @param $clm caseに適応するテーブルのカラム
     * @param $field ASの名前
     */
    public function sqlCase($clm, $field)
    {
        $case = "";
        foreach ($this->labels() as $key => $label) {
            $case .= " WHEN {$clm}='{$key}' THEN '{$label}' ";
        }
        $ret = "CASE {$case} END AS {$field}";
        return $ret;
    }

    /**
     * 対応するラベルを取得
     */
    public function label($id)
    {
        $labels = $this->labels();
        $ret = array_key_exists($id, $labels) ? $labels[$id] : "（未設定）";
        return $ret;
    }
}
