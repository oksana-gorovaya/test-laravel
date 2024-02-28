<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'id',
        'product_code',
        'name',
        'price',
    ];

    public function promos()
    {
        return $this->belongsToMany(Promo::class, 'promo_to_products');
    }
}
