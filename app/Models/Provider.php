<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    /** @use HasFactory<\Database\Factories\ProviderFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'ruc_number',
        'address',
        'phone',
        'PDF' => Barryvdh\DomPDF\Facade::class,
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
