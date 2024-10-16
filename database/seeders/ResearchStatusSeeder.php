<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResearchStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          //List of statuses
          $statueses = [
            ['name' => 'Under development'],
            ['name' => 'In clinical trials'],
            ['name' => 'Completed'],
        
        ];

        foreach ($statueses as $key => $value) {
            \App\Models\ResearchStatus::create($value);
        }
    }
}
