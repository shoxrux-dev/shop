<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'image',
        'parent_id',
        'slug'
    ];

    public static function getCategoriesByIds($categoryIds)
    {
        return Category::whereIn('id', $categoryIds)->get();
    }

    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'categories_products', 'category_id', 'product_id')->withTimestamps();
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'categories_sizes', 'category_id', 'size_id')->withTimestamps();
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'categories_brands', 'category_id', 'brand_id')->withTimestamps();
    }

}
