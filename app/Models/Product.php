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
    protected static function booted()
    {
        static::addGlobalScope('latest', function ($query) {
            $query->orderBy('created_at', 'desc');
        });
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'product_name'
            ]
        ];
    }
    public function scopeProductByOutlet(Builder $query, $slug = null, array $userFilter)
    {
        $query->whereHas('outlets', function (Builder $query) use ($slug) {
            $query->when($slug ?? null, function (Builder $query) use ($slug) {
                $query->where('slug', $slug);
            });
        });
        $query->whereHas($userFilter['role'] == 'SUPERVISOR' ? 'outlets.supervisor' : 'outlets.outletHasPegawai', function (Builder $query) use ($userFilter) {
            $query->where('users.user_id', $userFilter['user_id']);
        });
    }
    public function scopeApiProductByOutlet(Builder $query, $slug = null, $name)
    {
        $query->whereHas('outlets', function (Builder $query) use ($slug) {
            $query->where('slug', $slug);
        });
        $query->where('product_name', 'like', '%' . $name . '%');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'category_id');
    }
    public function opsi()
    {
        return $this->belongsToMany(Opsi::class, 'product_opsis', 'product_id', 'opsi_id');
    }
    public function bahans()
    {
        return $this->belongsToMany(Bahan::class, 'bahan_products', 'product_id', 'bahan_id')->withPivot('qty', 'satuan_bahan');
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
        return $this->belongsToMany(Pesanan::class, 'pesanan_product', 'pesanan_id', 'product_id')->withPivot('qty', 'harga', 'total');
    }
}
