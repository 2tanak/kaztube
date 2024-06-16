<?php

namespace Database\Factories;

use App\Models\Rubric;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * RubricFactory
 */
class RubricFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Rubric::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name_ru' => $this->faker->name(),
            'name_kz' => $this->faker->name(),
            'name_en' => $this->faker->name(),
        ];
    }
}
