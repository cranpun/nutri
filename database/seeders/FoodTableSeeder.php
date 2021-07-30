<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FoodTableSeeder extends Seeder
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

        \DB::table('food')->insert([
            ['name' => '豚肉', 'kana' => 'ぶたにく', 'category' => 'meat', 'favorite' => '0', ] + $base,
            ['name' => '卵', 'kana' => 'たまご', 'category' => 'etc', 'favorite' => '0', ] + $base,
            ['name' => '牛乳', 'kana' => 'ぎゅうにゅう', 'category' => 'etc', 'favorite' => '0', ] + $base,
        ]);
    }
}
