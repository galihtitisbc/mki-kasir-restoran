<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable;
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $guarded = ['product_id'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'product_name'
            ]
        ];
    }
    public function scopeProductByOutlet(Builder $query, $slug)
    {
        $query->whereHas('outlets', function (Builder $query) use ($slug) {
            $query->where('slug', '=', $slug);
        });
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'category_id');
    }
    public function outlets()
    {
        return $this->belongsToMany(Outlet::class, 'product_outlets', 'product_id', 'outlet_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
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
