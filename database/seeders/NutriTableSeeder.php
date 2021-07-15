<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NutriTableSeeder extends Seeder
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
            'dailyrequired' => 0,
        ];

        \DB::table('nutri')->insert([
            ['name' => 'タンパク質', 'pos' => 10] + $base,
            ['name' => '脂質', 'pos' => 20] + $base,
            ['name' => '飽和脂肪酸', 'pos' => 30] + $base,
            ['name' => 'n-6系脂肪酸', 'pos' => 40] + $base,
            ['name' => 'n-3系脂肪酸', 'pos' => 50] + $base,
            ['name' => '炭水化物', 'pos' => 60] + $base,
            ['name' => '食物繊維', 'pos' => 70] + $base,
            ['name' => 'ビタミンA', 'pos' => 80] + $base,
            ['name' => 'ビタミンD', 'pos' => 90] + $base,
            ['name' => 'ビタミンE', 'pos' => 100] + $base,
            ['name' => 'ビタミンK', 'pos' => 110] + $base,
            ['name' => 'ビタミンB1', 'pos' => 120] + $base,
            ['name' => 'ビタミンB2', 'pos' => 130] + $base,
            ['name' => 'ビタミンB6', 'pos' => 140] + $base,
            ['name' => 'ビタミンB12', 'pos' => 150] + $base,
            ['name' => 'ナイアシン', 'pos' => 160] + $base,
            ['name' => '葉酸', 'pos' => 170] + $base,
            ['name' => 'パントテン酸', 'pos' => 180] + $base,
            ['name' => 'ビオチン', 'pos' => 190] + $base,
            ['name' => 'ビタミンC', 'pos' => 200] + $base,
            ['name' => 'ナトリウム', 'pos' => 210] + $base,
            ['name' => 'カリウム', 'pos' => 220] + $base,
            ['name' => 'カルシウム', 'pos' => 230] + $base,
            ['name' => 'マグネシウム', 'pos' => 240] + $base,
            ['name' => 'リン', 'pos' => 250] + $base,
            ['name' => '鉄', 'pos' => 260] + $base,
            ['name' => '亜鉛', 'pos' => 270] + $base,
            ['name' => '銅', 'pos' => 280] + $base,
            ['name' => 'マンガン', 'pos' => 290] + $base,
            ['name' => 'ヨウ素', 'pos' => 300] + $base,
            ['name' => 'セレン', 'pos' => 310] + $base,
            ['name' => 'クロム', 'pos' => 320] + $base,
            ['name' => 'モリブデン', 'pos' => 330] + $base,
        ]);
    }
}
