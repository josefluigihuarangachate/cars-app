<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $name_category = array('red', '5 door', 'blue', '2 door', '4 door', 'black');

        for ($j = 0; $j < 6; $j++) {
            DB::table('categories')->insert([
                'name' => $name_category[$j],
                'slug' => Str::slug($name_category[$j])
            ]);
        }
    }
}
