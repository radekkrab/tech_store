<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\{Category, Tag, Product};

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/products', function (Request $request) {
    return Inertia::render('Products/Index', [
        'categories' => Category::where('is_active', true)->get(),
        'tags' => Tag::all(),
        'filters' => $request->only(['search', 'category', 'tag'])
    ]);
})->name('products.index');

Route::get('/products/{product}', function (Product $product) {
    if (!$product->is_active) {
        abort(404);
    }

    return Inertia::render('Products/Show', [
        'productId' => $product->id
    ]);
})->name('products.show');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
