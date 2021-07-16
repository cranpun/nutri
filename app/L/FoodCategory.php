<?php

namespace App\L;

class FoodCategory extends ZzzLabel
{
    const ID_VEGETABLE = "vegetable";
    const ID_MEAT = "meat";
    const ID_SEAFOOD = "seafood";
    const ID_GRAIN = "grain";
    const ID_SEASONING = "seasoning";
    const ID_ETC = "etc";

    public function labels()
    {
        return [
            self::ID_VEGETABLE => "野菜",
            self::ID_MEAT => "肉",
            self::ID_SEAFOOD => "魚介類",
            self::ID_GRAIN => "穀物",
            self::ID_SEASONING => "調味料",
            self::ID_ETC => "その他",
        ];
    }
}
