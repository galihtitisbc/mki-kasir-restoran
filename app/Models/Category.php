<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory, SoftDeletes, Sluggable;
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $guarded = ['category_id'];
    public $timestamps = false;

    public function scopeCategoryByOutlet(Builder $query, $slug = null, array $userFilter)
    {
        $query->whereHas('outlet', function (Builder $query) use ($slug) {
            $query->when($slug ?? null, function (Builder $query) use ($slug) {
                $query->where('slug', $slug);
            });
        });
        $query->whereHas($userFilter['role'] == 'SUPERVISOR' ? 'outlet.supervisor' : 'outlet.outletHasPegawai', function (Builder $query) use ($userFilter) {
            $query->where('user_id', $userFilter['user_id']);
        });
    }
    public function outlet()
    {
        return $this->belongsToMany(Outlet::class, 'category_outlets', 'category_id', 'outlet_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_products', 'category_id', 'product_id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'category_name'
            ]
        ];
    }
}
