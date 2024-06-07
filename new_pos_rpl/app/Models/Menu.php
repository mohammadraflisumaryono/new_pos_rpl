<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'icon',
        'url',
        'menu_parent',
        'menu_roles',
        'is_aktif',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function children()
    {
        return $this->hasMany(Menu::class, 'menu_parent');
    }
}
