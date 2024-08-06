<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "merchant_id",
        "pluck",
        "name",
        "price",
        "description",
    ];

    /**
     * Get all of the productImage for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}
