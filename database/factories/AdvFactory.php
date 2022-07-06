<?php

namespace Database\Factories;

use App\Models\Adv;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adv>
 */
class AdvFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'price' => rand(1200, 250000),
            'description' => fake()->text(1000),
            'images' =>  json_encode([fake()->text(50), fake()->text(50)])
        ];
    }

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Adv::class;
}
