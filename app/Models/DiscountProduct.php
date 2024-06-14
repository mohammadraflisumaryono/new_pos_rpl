<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'barcode',
        'image',
        'harga',
        'stock',
        'netto',
        'dimensi',
        'deskripsi',
    ];
}
