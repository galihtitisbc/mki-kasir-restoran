<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, Sluggable, SoftDeletes;
    protected $table = 'suppliers';
    protected $primaryKey = 'supplier_id';
    protected $guarded = ['supplier_id'];
    public function scopeSupplierByOutlet(Builder $query, $slug)
    {
        $query->whereHas('outlets', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id');
    }
    public function outlets()
    {
        return $this->belongsToMany(Outlet::class, 'supplier_outlets', 'supplier_id', 'outlet_id');
    }
    public function bahans()
    {
        return $this->hasMany(Bahan::class, 'supplier_id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'supplier_name'
            ]
        ];
    }
}
