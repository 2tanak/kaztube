<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * CategoryFactory
 */
class CategoryFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name_ru'   => $this->faker->name(),
            'name_kz'   => $this->faker->name(),
            'name_en'   => $this->faker->name(),
            'parent_id' => null,
        ];
    }
}
