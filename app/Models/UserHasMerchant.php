<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasMerchant extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "merchant_id",
    ];

    /**
     * Get the user that owns the UserHasMerchant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the merchant that owns the UserHasMerchant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant()
    {
        return $this->belongsTo(merchant::class, 'merchant_id', 'id');
    }
}
