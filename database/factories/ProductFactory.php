<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         // Generate a random manufacturing date
         $manufacturingDate = $this->faker->dateTimeBetween('now', '+2 years'); 
         
        return [
            
            'name' => $this->faker->unique()->randomElement([
                'Lyrica',
                'Lipitor',
                'Eliquis',
                'Prevnar',
                'Xeljanz',
                'Ibrance',
                'Chantix',
                'Zithromax',
                'Celebrex',
                'Norvasc',
                'Enbrel',
                'Diflucan'
            ]),
            'category' => $this->faker->randomElement([
                'tablet', 'capsule', 'injection'
            ]),
            'batch_number' => $this->faker->randomNumber(9, true),
            'research_status_id' => $this->faker->numberBetween(1, 3),
            'manufacturing_date' => $manufacturingDate->format('d-m-Y'),
            'expiration_date' => $this->faker->dateTimeBetween($manufacturingDate, '+3 years')->format('d-m-Y'),


        ];
    }
}
