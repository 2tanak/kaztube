<?php

namespace Database\Factories;

use App\Models\VideoFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFileFactory extends Factory
{
    protected $model = VideoFile::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'path' => $this->faker->text(),
            'mime' => $this->faker->text(),
            'size' => $this->faker->text(),
            'height' => $this->faker->randomNumber(),
            'width' => $this->faker->randomNumber(),
            'duration' => $this->faker->randomNumber(),
            'type' => $this->faker->text(),
        ];
    }
}
