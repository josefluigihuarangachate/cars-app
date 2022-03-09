<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        static $order = 1;

        for ($i = 0; $i < 8; $i++) {

            $id_car = $order++;

            DB::table('cars')->insert(
                [
                    'name' => 'car ' . $id_car,
                    'slug' => Str::slug('car-' . $id_car),
                    'price' => rand(15000, 30000),
                    'make' => 'Ford',
                    'model' => 'Fiesta',
                    'registration' => 'ABC123',
                    'engine_size' => '1.6',
                    'category_id' => rand(1, 6),
                    'image' => 'https://http2.mlstatic.com/D_NQ_NP_731664-MCO40978106967_032020-O.webp',
                ]
            );
        }
    }
}
