<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //List of ingredients names
        $ingredients = [
            ['name' => 'Lactose'],
            ['name' => 'Magnesium Stearate'],
            ['name' => 'Microcrystalline Cellulose'],
            ['name' => 'Talc'],
            ['name' => 'Silicon Dioxide'],
            ['name' => 'Starch'],
            ['name' => 'Calcium Carbonate'],
            ['name' => 'Sodium Starch Glycolate'],
            ['name' => 'Gelatin'],
            ['name' => 'Polyethylene Glycol'],
            ['name' => 'Hypromellose'],
            ['name' => 'Titanium Dioxide'],
            ['name' => 'Sucrose'],
            ['name' => 'Povidone'],
            ['name' => 'Propylene Glycol'],
            ['name' => 'Sodium Lauryl Sulfate'],
            ['name' => 'Citric Acid'],
            ['name' => 'Croscarmellose Sodium'],
            ['name' => 'Stearic Acid'],
            ['name' => 'Mannitol']
        ];

        foreach ($ingredients as $key => $value) {
            \App\Models\Ingredient::create($value);
        }
    }
}
