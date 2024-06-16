<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Genre;
use App\Models\Rubric;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoFile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AgeCategorySeeder::class,
        ]);

        User::factory()->create([
            'name' => 'KAZINSYS Admin',
            'email' => 'admin@kazinsys.kz',
        ]);
        User::factory(9)->create();
        Genre::factory(10)->create();
        Rubric::factory(10)->create();
        Category::factory(10)->create();
        Video::factory(10)->create();
        for ($i = 1; $i <= 10; $i++) {
            VideoFile::factory()->create([
                'video_id' => $i,
            ]);
        }
    }
}
