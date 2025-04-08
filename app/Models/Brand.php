<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $fillable = [
        'name',
        'image',
    ];

    // slug

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_brands', 'brand_id', 'category_id')->withTimestamps();
    }

}
