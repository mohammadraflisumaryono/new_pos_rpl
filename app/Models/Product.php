<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama',
        'barcode',
        'harga',
        'netto',
        'dimensi',
        'deskripsi',
        'stock'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function discountProducts()
    {
        return $this->hasMany(DiscountProduct::class);
    }

    public function getDiscount()
    {
        return $this->discountProducts()->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())->first();
    }
}
