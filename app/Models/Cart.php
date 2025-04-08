<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'product_id',
        'product_quantity',
        'product_color_id',
        'product_size_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function color() {
        return $this->belongsTo(ProductColor::class, 'product_color_id', 'id');
    }

    public function size() {
        return $this->belongsTo(Size::class, 'product_size_id', 'id');
    }

}
