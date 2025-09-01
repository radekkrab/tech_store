<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Электронные книги',
                'description' => 'Художественная и образовательная литература в формате PDF',
                'is_active' => true,
            ],
            [
                'name' => 'Учебные материалы',
                'description' => 'Учебники, методички и образовательные пособия',
                'is_active' => true,
            ],
            [
                'name' => 'Бизнес и финансы',
                'description' => 'Книги по бизнесу, инвестициям и финансовой грамотности',
                'is_active' => true,
            ],
            [
                'name' => 'Саморазвитие',
                'description' => 'Материалы по личностному росту и психологии',
                'is_active' => true,
            ],
            [
                'name' => 'Технологии и программирование',
                'description' => 'Книги по IT, программированию и digital-технологиям',
                'is_active' => true,
            ],
            [
                'name' => 'Архивные материалы',
                'description' => 'Неактивные и архивные PDF-файлы',
                'is_active' => false,
            ],
        ];

        foreach ($categories as $category) {
            Category::factory()->create($category);
        }
    }
}
