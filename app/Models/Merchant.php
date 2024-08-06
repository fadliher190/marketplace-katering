<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    /**
     * Get all of the hasAddress for the Merchant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hasAddress()
    {
        return $this->hasMany(MerchantHasAddress::class, 'merchant_id', 'id');
    }
}
