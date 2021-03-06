<?php

namespace Database\Factories;

use App\Models\Advertiser;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'description' => $this->faker->text,
            'category_id' => Category::factory()->create(),
            'advertiser_id' => Advertiser::factory()->create(),
            'type' => 'free',
            'start_date' => $this->faker->date,
        ];
    }
}
