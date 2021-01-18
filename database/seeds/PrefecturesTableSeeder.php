<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ['id' => 2, 'prefectures_name' => '青森県','image' => 'map-aomori.png'],
            ['id' => 3, 'prefectures_name' => '岩手県','image' => 'map-iwate.png'],
            ['id' => 1, 'prefectures_name' => '北海道','image' => 'map-hokkaido.png'],
            ['id' => 4, 'prefectures_name' => '宮城県','image' => 'map-miyagi.png'],
            ['id' => 5, 'prefectures_name' => '秋田県','image' => 'map-akita.png'],
            ['id' => 6, 'prefectures_name' => '山形県','image' => 'map-yamagata.png'],
            ['id' => 7, 'prefectures_name' => '福島県','image' => 'map-fukushima.png'],
            ['id' => 8, 'prefectures_name' => '茨城県','image' => 'map-ibaraki.png'],
            ['id' => 9, 'prefectures_name' => '栃木県','image' => 'map-tochigi.png'],
            ['id' => 10, 'prefectures_name' => '群馬県','image' => 'map-gunma.png'],
            ['id' => 11, 'prefectures_name' => '埼玉県','image' => 'map-saitama.png'],
            ['id' => 12, 'prefectures_name' => '千葉県','image' => 'map-chiba.png'],
            ['id' => 13, 'prefectures_name' => '東京都','image' => 'map-tokyo.png'],
            ['id' => 14, 'prefectures_name' => '神奈川県','image' => 'map-kanagawa.png'],
            ['id' => 15, 'prefectures_name' => '新潟県','image' => 'map-niigata.png'],
            ['id' => 16, 'prefectures_name' => '富山県','image' => 'map-toyama.png'],
            ['id' => 17, 'prefectures_name' => '石川県','image' => 'map-ishikawa.png'],
            ['id' => 18, 'prefectures_name' => '福井県','image' => 'map-fukui.png'],
            ['id' => 19, 'prefectures_name' => '山梨県','image' => 'map-yamanashi.png'],
            ['id' => 20, 'prefectures_name' => '長野県','image' => 'map-nagano.png'],
            ['id' => 21, 'prefectures_name' => '岐阜県','image' => 'map-gifu.png'],
            ['id' => 22, 'prefectures_name' => '静岡県','image' => 'map-shizuoka.png'],
            ['id' => 23, 'prefectures_name' => '愛知県','image' => 'map-aichi.png'],
            ['id' => 24, 'prefectures_name' => '三重県','image' => 'map-mie.png'],
            ['id' => 25, 'prefectures_name' => '滋賀県','image' => 'map-shiga.png'],
            ['id' => 26, 'prefectures_name' => '京都府','image' => 'map-kyoto.png'],
            ['id' => 27, 'prefectures_name' => '大阪府','image' => 'map-osaka.png'],
            ['id' => 28, 'prefectures_name' => '兵庫県','image' => 'map-hyogo.png'],
            ['id' => 29, 'prefectures_name' => '奈良県','image' => 'map-nara.png'],
            ['id' => 30, 'prefectures_name' => '和歌山県','image' => 'map-wakayama.png'],
            ['id' => 31, 'prefectures_name' => '鳥取県','image' => 'map-tottori.png'],
            ['id' => 32, 'prefectures_name' => '島根県','image' => 'map-shimane.png'],
            ['id' => 33, 'prefectures_name' => '岡山県','image' => 'map-okayama.png'],
            ['id' => 34, 'prefectures_name' => '広島県','image' => 'map-hiroshima.png'],
            ['id' => 35, 'prefectures_name' => '山口県','image' => 'map-yamaguchi.png'],
            ['id' => 36, 'prefectures_name' => '徳島県','image' => 'map-tokushima.png'],
            ['id' => 37, 'prefectures_name' => '香川県','image' => 'map-kagawa.png'],
            ['id' => 38, 'prefectures_name' => '愛媛県','image' => 'map-ehime.png'],
            ['id' => 39, 'prefectures_name' => '高知県','image' => 'map-kochi.png'],
            ['id' => 40, 'prefectures_name' => '福岡県','image' => 'map-fukuoka.png'],
            ['id' => 41, 'prefectures_name' => '佐賀県','image' => 'map-saga.png'],
            ['id' => 42, 'prefectures_name' => '長崎県','image' => 'map-nagasaki.png'],
            ['id' => 43, 'prefectures_name' => '熊本県','image' => 'map-kumamoto.png'],
            ['id' => 44, 'prefectures_name' => '大分県','image' => 'map-oita.png'],
            ['id' => 45, 'prefectures_name' => '宮崎県','image' => 'map-miyazaki.png'],
            ['id' => 46, 'prefectures_name' => '鹿児島県','image' => 'map-kagoshima.png'],
            ['id' => 47, 'prefectures_name' => '沖縄県','image' => 'map-okinawa.png'],
        ]);
    }
}
