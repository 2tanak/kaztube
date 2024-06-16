<?php

namespace Database\Seeders;

use App\Models\AgeCategory;
use Illuminate\Database\Seeder;

class AgeCategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AgeCategory::insert([
            [
                'title' => json_encode(['ru' => 'Нет возрастных ограничений']),
                'mpaa'  => 'G',
            ],
            [
                'title' => json_encode(['ru' => 'Рекомендуется присутствие родителей']),
                'mpaa'  => 'PG',
            ],
            [
                'title' => json_encode(['ru' => 'Детям до 13 лет просмотр не желателен']),
                'mpaa'  => 'PG-13',
            ],
            [
                'title' => json_encode(['ru' => 'Лицам до 17 лет обязательно присутствие взрослого']),
                'mpaa'  => 'R',
            ],
            [
                'title' => json_encode(['ru' => 'Лицам до 18 лет просмотр запрещен']),
                'mpaa'  => 'NC-17',
            ],
        ]);
    }
}
