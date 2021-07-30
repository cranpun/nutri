<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FoodnutriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $base = [
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        \DB::table('foodnutri')->insert([
            ['food_id' => 1, 'nutri_id' => 1] + $base,    ['food_id' => 1, 'nutri_id' => 2] + $base,    ['food_id' => 1, 'nutri_id' => 3] + $base,    ['food_id' => 1, 'nutri_id' => 4] + $base,                                ['food_id' => 1, 'nutri_id' => 12] + $base,        ['food_id' => 1, 'nutri_id' => 14] + $base,        ['food_id' => 1, 'nutri_id' => 16] + $base,                                            ['food_id' => 1, 'nutri_id' => 27] + $base,                    ['food_id' => 1, 'nutri_id' => 32] + $base,
            ['food_id' => 2, 'nutri_id' => 1] + $base,            ['food_id' => 2, 'nutri_id' => 4] + $base,                ['food_id' => 2, 'nutri_id' => 8] + $base,                                        ['food_id' => 2, 'nutri_id' => 18] + $base,    ['food_id' => 2, 'nutri_id' => 19] + $base,                        ['food_id' => 2, 'nutri_id' => 25] + $base,                        ['food_id' => 2, 'nutri_id' => 31] + $base,
            ['food_id' => 3, 'nutri_id' => 1] + $base,                            ['food_id' => 3, 'nutri_id' => 8] + $base,                    ['food_id' => 3, 'nutri_id' => 13] + $base,                                        ['food_id' => 3, 'nutri_id' => 23] + $base,        ['food_id' => 3, 'nutri_id' => 25] + $base,
        ]);
    }
}
