<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получаем категории
        $ebooksCategory = Category::where('name', 'Электронные книги')->first();
        $educationCategory = Category::where('name', 'Учебные материалы')->first();
        $businessCategory = Category::where('name', 'Бизнес и финансы')->first();
        $selfdevCategory = Category::where('name', 'Саморазвитие')->first();
        $techCategory = Category::where('name', 'Технологии и программирование')->first();

        // Получаем теги
        $newTag = Tag::where('name', 'новинка')->first();
        $bestsellerTag = Tag::where('name', 'бестселлер')->first();
        $discountTag = Tag::where('name', 'со скидкой')->first();
        $premiumTag = Tag::where('name', 'премиум')->first();
        $popularTag = Tag::where('name', 'популярное')->first();
        $russianTag = Tag::where('name', 'русский язык')->first();
        $englishTag = Tag::where('name', 'английский язык')->first();
        $educationTag = Tag::where('name', 'образовательное')->first();
        $fictionTag = Tag::where('name', 'художественное')->first();
        $businessTag = Tag::where('name', 'бизнес')->first();
        $programmingTag = Tag::where('name', 'программирование')->first();
        $selfdevTag = Tag::where('name', 'саморазвитие')->first();

        $products = [
            // Электронные книги
            [
                'name' => 'Мастер и Маргарита - Михаил Булгаков',
                'description' => 'Полная версия знаменитого романа Михаила Булгакова в высоком качестве PDF',
                'price' => 299.99,
                'file_path' => 'books/master-i-margarita.pdf',
                'is_active' => true,
                'category_id' => $ebooksCategory->id,
                'tags' => [$fictionTag->id, $russianTag->id, $bestsellerTag->id]
            ],
            [
                'name' => '1984 - George Orwell',
                'description' => 'Классика антиутопии на английском языке, оригинальный текст',
                'price' => 349.99,
                'file_path' => 'books/1984-orwell.pdf',
                'is_active' => true,
                'category_id' => $ebooksCategory->id,
                'tags' => [$fictionTag->id, $englishTag->id, $popularTag->id]
            ],

            // Учебные материалы
            [
                'name' => 'Сборник задач по математике для вузов',
                'description' => 'Комплексный сборник задач с решениями для студентов технических специальностей',
                'price' => 499.99,
                'file_path' => 'education/math-problems.pdf',
                'is_active' => true,
                'category_id' => $educationCategory->id,
                'tags' => [$educationTag->id, $russianTag->id, $newTag->id]
            ],
            [
                'name' => 'Английская грамматика для начинающих',
                'description' => 'Подробное руководство по грамматике английского языка с упражнениями',
                'price' => 399.99,
                'file_path' => 'education/english-grammar.pdf',
                'is_active' => true,
                'category_id' => $educationCategory->id,
                'tags' => [$educationTag->id, $englishTag->id, $popularTag->id]
            ],

            // Бизнес и финансы
            [
                'name' => 'Богатый папа, бедный папа - Роберт Кийосаки',
                'description' => 'Знаменитая книга о финансовой грамотности и инвестициях',
                'price' => 449.99,
                'file_path' => 'business/rich-dad-poor-dad.pdf',
                'is_active' => true,
                'category_id' => $businessCategory->id,
                'tags' => [$businessTag->id, $russianTag->id, $bestsellerTag->id]
            ],
            [
                'name' => '7 навыков высокоэффективных людей',
                'description' => 'Классика бизнес-литературы о личной эффективности',
                'price' => 399.99,
                'file_path' => 'business/7-habits.pdf',
                'is_active' => true,
                'category_id' => $businessCategory->id,
                'tags' => [$businessTag->id, $selfdevTag->id, $popularTag->id]
            ],

            // Саморазвитие
            [
                'name' => 'Сила настоящего - Экхарт Толле',
                'description' => 'Книга о осознанности и жизни в настоящем моменте',
                'price' => 379.99,
                'file_path' => 'selfdev/power-of-now.pdf',
                'is_active' => true,
                'category_id' => $selfdevCategory->id,
                'tags' => [$selfdevTag->id, $russianTag->id, $newTag->id]
            ],

            // Технологии и программирование
            [
                'name' => 'Laravel: Полное руководство для разработчика',
                'description' => 'Подробное руководство по фреймворку Laravel с примерами и лучшими практиками',
                'price' => 599.99,
                'file_path' => 'tech/laravel-guide.pdf',
                'is_active' => true,
                'category_id' => $techCategory->id,
                'tags' => [$programmingTag->id, $russianTag->id, $premiumTag->id]
            ],
            [
                'name' => 'JavaScript: The Good Parts',
                'description' => 'Классическая книга о лучших практиках JavaScript на английском языке',
                'price' => 529.99,
                'file_path' => 'tech/javascript-good-parts.pdf',
                'is_active' => true,
                'category_id' => $techCategory->id,
                'tags' => [$programmingTag->id, $englishTag->id, $bestsellerTag->id]
            ],

            // Товар со скидкой
            [
                'name' => 'Основы Python для начинающих',
                'description' => 'Введение в программирование на Python с нуля',
                'price' => 249.99,
                'file_path' => 'tech/python-basics.pdf',
                'is_active' => true,
                'category_id' => $techCategory->id,
                'tags' => [$programmingTag->id, $russianTag->id, $discountTag->id]
            ],

            // Неактивный товар
            [
                'name' => 'Устаревший курс по WordPress',
                'description' => 'Этот материал больше не обновляется и не рекомендуется к покупке',
                'price' => 199.99,
                'file_path' => 'archive/wordpress-old.pdf',
                'is_active' => false,
                'category_id' => $techCategory->id,
                'tags' => []
            ],
        ];

        foreach ($products as $productData) {
            $tags = $productData['tags'] ?? [];
            unset($productData['tags']);

            $product = Product::factory()->create($productData);

            if (!empty($tags)) {
                $product->tags()->attach($tags);
            }
        }
    }
}
