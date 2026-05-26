<?php

namespace Database\Seeders;

use App\Models\MealOption;
use Illuminate\Database\Seeder;

class MealOptionSeeder extends Seeder
{
    public function run(): void
    {
        $options = [
            'Grilled Mahi-Mahi',
            'Island Jerk Chicken',
            'Coconut Curry (Vegetarian)',
            'Garden Vegan Plate',
        ];

        foreach ($options as $index => $name) {
            MealOption::firstOrCreate(
                ['name' => $name],
                ['sort_order' => $index + 1, 'is_active' => true],
            );
        }
    }
}
