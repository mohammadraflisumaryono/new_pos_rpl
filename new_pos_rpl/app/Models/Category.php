<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'category_id';
    protected $fillable = ['nama'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id');
    }
}
