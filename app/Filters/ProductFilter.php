<?php

namespace App\Filters;

use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Product;

class ProductFilter
{
    public static function apply($query = null)
    {
        $baseQuery = $query ?: Product::query();

        return QueryBuilder::for($baseQuery)
            ->with(['category', 'tags'])
            ->where('is_active', true)
            ->latest()
            ->allowedFilters(self::getAllowedFilters())
            ->paginate(12);
    }

    public static function getAllowedFilters()
    {
        return [
            AllowedFilter::partial('search', 'name'),
            AllowedFilter::exact('category', 'category.id'),
            AllowedFilter::exact('tags', 'tags.id'),
        ];
    }

    // Альтернативный метод для получения только allowedFilters
    public static function filters()
    {
        return self::getAllowedFilters();
    }
}
