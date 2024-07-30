<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outlet extends Model
{
    use HasFactory, SoftDeletes, Sluggable;
    protected $table = 'outlets';
    protected $primaryKey = 'outlet_id';
    protected $guarded = ['outlet_id'];

    public function bahans()
    {
        return $this->belongsToMany(Bahan::class, 'bahan_outlets', 'outlet_id', 'bahan_id');
    }
    public function salesHistories()
    {
        return $this->hasMany(SalesHistory::class, 'outlet_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_outlets', 'outlet_id', 'product_id');
    }
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
    public function taxs()
    {
        return $this->belongsToMany(Tax::class, 'tax_outlets', 'outlet_id', 'tax_id');
    }
    public function mejas()
    {
        return $this->hasMany(Meja::class, 'outlet_id');
    }
    public function categories()
    {
        return $this->hasMany(Category::class, 'outlet_id');
    }
    public function suppliers()
    {
        return $this->hasMany(Supplier::class, 'outlet_id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'outlet_name'
            ]
        ];
    }
}
