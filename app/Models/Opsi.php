<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opsi extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $guarded = ['id'];
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
                'source' => 'opsi_name'
            ]
        ];
    }
    public function scopeOpsiByOutlet(Builder $query, $slug)
    {
        $query->whereHas('outlet', function ($query) use ($slug) {
            $query->when($slug ?? null, function ($query) use ($slug) {
                return $query->where('slug', $slug);
            });
        });
    }
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
    public function detailOpsi()
    {
        return $this->hasMany(DetailOpsi::class, 'opsi_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'detail_opsis', 'opsi_id', 'product_id');
    }
}
