<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class FakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate 10 fake users
        for ($i = 0; $i < 20; $i++) {

            $insertId = DB::table('ads')->insertGetId([

                'ad_number' => $faker->numberBetween(000000, 9999999),
                'ad_title' => $faker->text(40),
                'ad_district' => "Batticaloa",
                'ad_city' => "Addalaichenai",
                'ad_description' => $faker->text(440),
                'ad_price' => $faker->numberBetween(000000.00, 9999999.00),
                'ad_view_count' => $faker->numberBetween(001, 999),
                'ad_expire_date' => Carbon::now()->addDays(30),
                'status' => 1,
                'vehicle_types_id' => 5,
                'brands_id' => 2,
                'models_id' => 1,
                'ads_condition' => 'Used',
                'ads_parts_accessory_type' => 'Body Components',
                'ads_customers_id' => 11,
                'is_top_id' => 0,
                'top_ad_expire_date' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'adminStatus' => null,

            ]);


            DB::table('ads_images')->insert([
                'name' => '1692872309705.jpg',
                'ads_id' => $insertId,

            ]);
        }
    }
}
