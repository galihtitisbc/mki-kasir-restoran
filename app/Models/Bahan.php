<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;
    protected $primaryKey = 'bahan_id';
    protected $guarded = ['bahan_id'];
    public function outlets()
    {
        return $this->belongsToMany(Outlet::class, 'bahan_outlets', 'bahan_id', 'outlet_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'bahan_products', 'bahan_id', 'product_id');
    }
}
