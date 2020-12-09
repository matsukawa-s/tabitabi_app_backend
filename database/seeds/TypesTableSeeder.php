<?php

use Illuminate\Database\Seeder;

class ClassificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            ['id' => 1, 'english_name' => 'accounting', 'japanese_name' => '会計事務所'],
            ['id' => 2, 'english_name' => 'airport', 'japanese_name' => '空港'],
            ['id' => 3, 'english_name' => 'amusement_park', 'japanese_name' => '遊園地'],
            ['id' => 4, 'english_name' => 'aquarium', 'japanese_name' => '水族館'],
            ['id' => 5, 'english_name' => 'art_gallery', 'japanese_name' => '美術館'],
            ['id' => 6, 'english_name' => 'atm', 'japanese_name' => 'ATM'],
            ['id' => 7, 'english_name' => 'bakery', 'japanese_name' => 'パン屋'],
            ['id' => 8, 'english_name' => 'bank', 'japanese_name' => '銀行'],
            ['id' => 9, 'english_name' => 'bar', 'japanese_name' => 'バー'],
            ['id' => 10, 'english_name' => 'beauty_salon', 'japanese_name' => '美容室'],
            ['id' => 11, 'english_name' => 'bicycle_store', 'japanese_name' => '自転車屋'],
            ['id' => 12, 'english_name' => 'book_store', 'japanese_name' => '書店'],
            ['id' => 13, 'english_name' => 'bowling_alley', 'japanese_name' => 'ボウリング場'],
            ['id' => 14, 'english_name' => 'bus_station', 'japanese_name' => 'バス停'],
            ['id' => 15, 'english_name' => 'cafe', 'japanese_name' => 'カフェ'],
            ['id' => 16, 'english_name' => 'campground', 'japanese_name' => 'キャンプ場'],
            ['id' => 17, 'english_name' => 'car_dealer', 'japanese_name' => '自動車ディーラー'],
            ['id' => 18, 'english_name' => 'car_rental', 'japanese_name' => 'レンタカー屋'],
            ['id' => 19, 'english_name' => 'car_repair', 'japanese_name' => '自動車修理, 板金屋'],
            ['id' => 20, 'english_name' => 'car_wash', 'japanese_name' => '洗車'],
            ['id' => 21, 'english_name' => 'casino', 'japanese_name' => 'カジノ'],
            ['id' => 22, 'english_name' => 'cemetery', 'japanese_name' => '墓地'],
            ['id' => 23, 'english_name' => 'church', 'japanese_name' => '教会'],
            ['id' => 24, 'english_name' => 'city_hall', 'japanese_name' => '市役所'],
            ['id' => 25, 'english_name' => 'clothing_store', 'japanese_name' => '洋服店'],
            ['id' => 26, 'english_name' => 'convenience_store', 'japanese_name' => 'コンビニ'],
            ['id' => 27, 'english_name' => 'courthouse', 'japanese_name' => '裁判所'],
            ['id' => 28, 'english_name' => 'dentist', 'japanese_name' => '歯科'],
            ['id' => 29, 'english_name' => 'department_store', 'japanese_name' => 'デパート'],
            ['id' => 30, 'english_name' => 'doctor', 'japanese_name' => '医者'],
            ['id' => 31, 'english_name' => 'electrician', 'japanese_name' => '電気事業者'],
            ['id' => 32, 'english_name' => 'electronics_store', 'japanese_name' => '電器屋'],
            ['id' => 33, 'english_name' => 'embassy', 'japanese_name' => '大使館'],
            ['id' => 34, 'english_name' => 'finance', 'japanese_name' => '財務機関'],
            ['id' => 35, 'english_name' => 'fire_station', 'japanese_name' => '消防署'],
            ['id' => 36, 'english_name' => 'florist', 'japanese_name' => '花屋'],
            ['id' => 37, 'english_name' => 'food', 'japanese_name' => '飲食店'],
            ['id' => 38, 'english_name' => 'funeral_home', 'japanese_name' => '斎場'],
            ['id' => 39, 'english_name' => 'furniture_store', 'japanese_name' => '家具屋'],
            ['id' => 40, 'english_name' => 'gas_station', 'japanese_name' => 'ガソリンスタンド'],
            ['id' => 41, 'english_name' => 'general_contractor', 'japanese_name' => 'ゼネコン'],
            ['id' => 42, 'english_name' => 'grocery_or_supermarket', 'japanese_name' => '日用品店, スーパーマーケット'],
            ['id' => 43, 'english_name' => 'gym', 'japanese_name' => 'スポーツジム'],
            ['id' => 44, 'english_name' => 'hair_care', 'japanese_name' => '床屋'],
            ['id' => 45, 'english_name' => 'hardware_store', 'japanese_name' => '工具店, ホームセンター'],
            ['id' => 46, 'english_name' => 'health', 'japanese_name' => '医療機関'],
            ['id' => 47, 'english_name' => 'hindu_temple', 'japanese_name' => 'ヒンドゥー寺院'],
            ['id' => 48, 'english_name' => 'home_goods_store', 'japanese_name' => 'ホームセンター'],
            ['id' => 49, 'english_name' => 'hospital', 'japanese_name' => '医療機関'],
            ['id' => 50, 'english_name' => 'insurance_agency', 'japanese_name' => '保険代理店'],
            ['id' => 51, 'english_name' => 'jewelry_store', 'japanese_name' => '宝石店'],
            ['id' => 52, 'english_name' => 'laundry', 'japanese_name' => 'クリーニング店, コインランドリー'],
            ['id' => 53, 'english_name' => 'lawyer', 'japanese_name' => '法律事務所'],
            ['id' => 54, 'english_name' => 'library', 'japanese_name' => '図書館'],
            ['id' => 55, 'english_name' => 'liquor_store', 'japanese_name' => '酒店'],
            ['id' => 56, 'english_name' => 'local_government_office', 'japanese_name' => '地方公共団体'],
            ['id' => 57, 'english_name' => 'locksmith', 'japanese_name' => '鍵屋'],
            ['id' => 58, 'english_name' => 'lodging', 'japanese_name' => '宿泊施設'],
            ['id' => 59, 'english_name' => 'meal_delivery', 'japanese_name' => '飲食店（出前形式'],
            ['id' => 60, 'english_name' => 'meal_takeaway', 'japanese_name' => '飲食店（テイクアウト形式'],
            ['id' => 61, 'english_name' => 'mosque', 'japanese_name' => 'モスク'],
            ['id' => 62, 'english_name' => 'movie_rental', 'japanese_name' => 'ビデオレンタル屋'],
            ['id' => 63, 'english_name' => 'movie_theater', 'japanese_name' => '映画館'],
            ['id' => 64, 'english_name' => 'moving_company', 'japanese_name' => '運送屋, 引越し屋'],
            ['id' => 65, 'english_name' => 'museum', 'japanese_name' => '博物館, ミュージアム'],
            ['id' => 66, 'english_name' => 'night_club', 'japanese_name' => 'ナイトクラブ'],
            ['id' => 67, 'english_name' => 'painter', 'japanese_name' => '塗装屋'],
            ['id' => 68, 'english_name' => 'park', 'japanese_name' => '公園'],
            ['id' => 69, 'english_name' => 'parking', 'japanese_name' => '駐車場'],
            ['id' => 70, 'english_name' => 'pet_store', 'japanese_name' => 'ペット屋'],
            ['id' => 71, 'english_name' => 'pharmacy', 'japanese_name' => '薬局'],
            ['id' => 72, 'english_name' => 'physiotherapist', 'japanese_name' => '療法士'],
            ['id' => 73, 'english_name' => 'place_of_worship', 'japanese_name' => '神社、寺'],
            ['id' => 74, 'english_name' => 'plumber', 'japanese_name' => '配管工, 水道業者'],
            ['id' => 75, 'english_name' => 'police', 'japanese_name' => '警察署, 交番'],
            ['id' => 76, 'english_name' => 'post_office', 'japanese_name' => '郵便局'],
            ['id' => 77, 'english_name' => 'real_estate_agency', 'japanese_name' => '不動産業者'],
            ['id' => 78, 'english_name' => 'restaurant', 'japanese_name' => 'レストラン'],
            ['id' => 79, 'english_name' => 'roofing_contractor', 'japanese_name' => '屋根屋'],
            ['id' => 80, 'english_name' => 'rv_park', 'japanese_name' => 'RVパーク'],
            ['id' => 81, 'english_name' => 'school', 'japanese_name' => '学校、塾、習い事'],
            ['id' => 82, 'english_name' => 'shoe_store', 'japanese_name' => '靴屋'],
            ['id' => 83, 'english_name' => 'shopping_mall', 'japanese_name' => 'ショッピングモール'],
            ['id' => 84, 'english_name' => 'spa', 'japanese_name' => '温泉, 銭湯'],
            ['id' => 85, 'english_name' => 'stadium', 'japanese_name' => 'スタジアム'],
            ['id' => 86, 'english_name' => 'storage', 'japanese_name' => '倉庫'],
            ['id' => 87, 'english_name' => 'store', 'japanese_name' => '店'],
            ['id' => 88, 'english_name' => 'subway_station', 'japanese_name' => '地下鉄駅'],
            ['id' => 89, 'english_name' => 'synagogue', 'japanese_name' => 'シナゴーグ'],
            ['id' => 90, 'english_name' => 'taxi_stand', 'japanese_name' => 'タクシー乗り場'],
            ['id' => 91, 'english_name' => 'train_station', 'japanese_name' => '鉄道駅'],
            ['id' => 92, 'english_name' => 'travel_agency', 'japanese_name' => '旅行代理店'],
            ['id' => 93, 'english_name' => 'university', 'japanese_name' => '大学'],
            ['id' => 94, 'english_name' => 'veterinary_care', 'japanese_name' => '動物病院'],
            ['id' => 95, 'english_name' => 'zoo', 'japanese_name' => '動物園'],

        ]);
    }
}
