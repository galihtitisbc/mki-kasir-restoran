<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'category_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function varians()
    {
        return $this->hasMany(Varian::class, 'product_id');
    }
    public function salesHistories()
    {
        return $this->hasMany(SalesHistory::class, 'product_id');
    }
    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'product_id');
    }
}
