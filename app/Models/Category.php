<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_products', 'category_id', 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
