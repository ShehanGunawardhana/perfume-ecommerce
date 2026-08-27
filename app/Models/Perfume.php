<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfume extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'brand', 'description', 'price', 'discount_price',
        'stock', 'gender', 'volume', 'main_image', 'fragrance_family', 'concentration',
        'top_notes', 'middle_notes', 'base_notes', 'longevity', 'season', 'occasion',
        'is_featured', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'discount_price' => 'decimal:2',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(PerfumeImage::class)->orderBy('sort_order');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getDisplayPriceAttribute(): float
    {
        return (float) ($this->discount_price ?? $this->price);
    }

    public function getIsOnSaleAttribute(): bool
    {
        return ! is_null($this->discount_price) && $this->discount_price < $this->price;
    }

    public function getInStockAttribute(): bool
    {
        return $this->stock > 0;
    }
}
