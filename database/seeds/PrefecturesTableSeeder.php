<?php

use Illuminate\Database\Seeder;

class PrefecturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prefectures')->insert([
            ['id' => 1, 'prefectures_name' => '北海道'],
            ['id' => 2, 'prefectures_name' => '青森県'],
            ['id' => 3, 'prefectures_name' => '岩手県'],
            ['id' => 4, 'prefectures_name' => '宮城県'],
            ['id' => 5, 'prefectures_name' => '秋田県'],
            ['id' => 6, 'prefectures_name' => '山形県'],
            ['id' => 7, 'prefectures_name' => '福島県'],
            ['id' => 8, 'prefectures_name' => '茨城県'],
            ['id' => 9, 'prefectures_name' => '栃木県'],
            ['id' => 10, 'prefectures_name' => '群馬県'],
            ['id' => 11, 'prefectures_name' => '埼玉県'],
            ['id' => 12, 'prefectures_name' => '千葉県'],
            ['id' => 13, 'prefectures_name' => '東京都'],
            ['id' => 14, 'prefectures_name' => '神奈川県'],
            ['id' => 15, 'prefectures_name' => '新潟県'],
            ['id' => 16, 'prefectures_name' => '富山県'],
            ['id' => 17, 'prefectures_name' => '石川県'],
            ['id' => 18, 'prefectures_name' => '福井県'],
            ['id' => 19, 'prefectures_name' => '山梨県'],
            ['id' => 20, 'prefectures_name' => '長野県'],
            ['id' => 21, 'prefectures_name' => '岐阜県'],
            ['id' => 22, 'prefectures_name' => '静岡県'],
            ['id' => 23, 'prefectures_name' => '愛知県'],
            ['id' => 24, 'prefectures_name' => '三重県'],
            ['id' => 25, 'prefectures_name' => '滋賀県'],
            ['id' => 26, 'prefectures_name' => '京都府'],
            ['id' => 27, 'prefectures_name' => '大阪府'],
            ['id' => 28, 'prefectures_name' => '兵庫県'],
            ['id' => 29, 'prefectures_name' => '奈良県'],
            ['id' => 30, 'prefectures_name' => '和歌山県'],
            ['id' => 31, 'prefectures_name' => '鳥取県'],
            ['id' => 32, 'prefectures_name' => '島根県'],
            ['id' => 33, 'prefectures_name' => '岡山県'],
            ['id' => 34, 'prefectures_name' => '広島県'],
            ['id' => 35, 'prefectures_name' => '山口県'],
            ['id' => 36, 'prefectures_name' => '徳島県'],
            ['id' => 37, 'prefectures_name' => '香川県'],
            ['id' => 38, 'prefectures_name' => '愛媛県'],
            ['id' => 39, 'prefectures_name' => '高知県'],
            ['id' => 40, 'prefectures_name' => '福岡県'],
            ['id' => 41, 'prefectures_name' => '佐賀県'],
            ['id' => 42, 'prefectures_name' => '長崎県'],
            ['id' => 43, 'prefectures_name' => '熊本県'],
            ['id' => 44, 'prefectures_name' => '大分県'],
            ['id' => 45, 'prefectures_name' => '宮崎県'],
            ['id' => 46, 'prefectures_name' => '鹿児島県'],
            ['id' => 47, 'prefectures_name' => '沖縄県'],
        ]);
    }
}
