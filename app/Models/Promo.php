<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'discount_percent',
        'min_item_quantity',
        'max_item_quantity',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'promo_to_products',
            'promo_id',
            'product_id'
        );
    }
}
