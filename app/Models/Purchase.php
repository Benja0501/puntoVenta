<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'user_id',
        'purchase_date',
        'tax',
        'total',
        'status',
        'picture',
    ];
    protected $casts = [
        'purchase_date' => 'datetime',
    ];
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetails::class, 'shopping_id');
    }
}
