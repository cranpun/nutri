<?php

namespace App\L;

class MenuTiming extends ZzzLabel
{
    const ID_DINNER = "dinner";
    const ID_LUNCH = "lunch";
    const ID_BREAKFAST = "breakfast";

    public function labels()
    {
        return [
            self::ID_DINNER => "夕食",
            self::ID_LUNCH => "昼食",
            self::ID_BREAKFAST => "朝食",
        ];
    }
}
