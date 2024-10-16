<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        // Insert random data into the database using DB facade (query builder)
        for ($i = 1; $i < 11; $i++) {
            
            // Create a Faker instance
            $faker = Faker::create();

            $iterations = rand(2, 5);
            for ($j = 1; $j < $iterations; $j++) {


                DB::table('products_ingredients')->insert([
                    'product_id' => $i,
                    'ingredient_id' => $faker->unique()->numberBetween(1, 20),
                    'quantity' => $faker->numberBetween(1, 10),
                    'created_at' => now(), 
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
