<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        "number",
        "merchant_id",
        "user_id",
        "name",
        "phone",
        "address",
        "status",
    ];

    /**
     * Get the merchant that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant()
    {
        return $this->belongsTo(merchant::class, 'merchant_id', 'id');
    }
    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all of the detailOrder for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailOrder()
    {
        return $this->hasMany(DetailOrder::class, 'order_id', 'id');
    }
}
