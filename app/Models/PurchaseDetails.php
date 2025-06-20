<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'shopping_id',
        'product_id',
        'quantity',
        'price',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'shopping_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
