<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;
    protected $table = 'product_colors';
    protected $fillable =[
        'name',
        'image',
        'slug',
        'product_id'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }


}
