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
    public function scopeBahanByOutlet(Builder $query, $slug)
    {
        $query->whereHas('outlets', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }
    public function outlets()
    {
        return $this->belongsToMany(Outlet::class, 'bahan_outlets', 'bahan_id', 'outlet_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'bahan_products', 'bahan_id', 'product_id')->withPivot('qty', 'satuan_bahan');
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
