<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'новинка'],
            ['name' => 'бестселлер'],
            ['name' => 'со скидкой'],
            ['name' => 'премиум'],
            ['name' => 'популярное'],
            ['name' => 'ограниченный тираж'],
            ['name' => 'instant access'],
            ['name' => 'русский язык'],
            ['name' => 'английский язык'],
            ['name' => 'образовательное'],
            ['name' => 'художественное'],
            ['name' => 'научное'],
            ['name' => 'бизнес'],
            ['name' => 'программирование'],
            ['name' => 'саморазвитие'],
        ];

        foreach ($tags as $tag) {
            Tag::factory()->create($tag);
        }
    }
}
