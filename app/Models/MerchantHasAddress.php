<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantHasAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        "merchant_id",
        "phone",
        "address",
    ];
}
