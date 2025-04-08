<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Size extends Model
{
    use HasFactory;
    protected $table = 'sizes';
    protected $fillable = [
        'name',
        'slug'
    ];

    public static function getSizesByIds($sizeIds)
    {
        return Size::whereIn('id', $sizeIds)->get();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_sizes', 'size_id', 'product_id')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_sizes', 'size_id', 'category_id')->withTimestamps();
    }

}
