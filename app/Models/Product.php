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
    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
