<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bahan extends Model
{
    use HasFactory, SoftDeletes, Sluggable;
    protected $primaryKey = 'bahan_id';
    protected $guarded = ['bahan_id'];
    public function scopeBahanByOutlet(Builder $query, $slug, array $userFilter)
    {
        $query->whereHas('outlets', function ($query) use ($slug) {
            $query->when($slug ?? null, function (Builder $query) use ($slug) {
                $query->where('slug', $slug);
            });
        });
        $query->whereHas($userFilter['role'] == 'SUPERVISOR' ? 'outlets.supervisor' : 'outlets.outletHasPegawai', function (Builder $query) use ($userFilter) {
            $query->where('user_id', $userFilter['user_id']);
        });
    }
    public function outlets()
    {
        return $this->belongsToMany(Outlet::class, 'bahan_outlets', 'bahan_id', 'outlet_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'bahan_products', 'bahan_id', 'product_id');
    }
    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class, 'bahan_id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_bahan'
            ]
        ];
    }
}
