<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $guarded = ['category_id'];
    public $timestamps = false;

    public function scopeCategoryByOutlet(Builder $query, $slug)
    {
        return $query->whereHas('outlet', function (Builder $query) use ($slug) {
            $query->where('slug', $slug);
        });
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_products', 'category_id', 'product_id');
    }
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
}
