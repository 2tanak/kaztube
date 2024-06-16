<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => $this->faker->randomElement(\DB::table('users')->pluck('id')),
            'title_ru'    => $this->faker->name(),
            'title_kz'    => $this->faker->name(),
            'title_en'    => $this->faker->name(),
            'description_ru' => $this->faker->text(),
            'description_kz' => $this->faker->text(),
            'description_en' => $this->faker->text(),
            'category_id' => $this->faker->numberBetween(1, 10),
            'rubric_id'   => $this->faker->numberBetween(1, 10),
            'genre_id'   => $this->faker->numberBetween(1, 10),
            'age_category_id'   => $this->faker->numberBetween(1, 5),
        ];
    }
}
