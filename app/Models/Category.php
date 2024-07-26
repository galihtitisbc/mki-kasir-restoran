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

    public function scopeCategoryByOutlet(Builder $query, $slug = null)
    {
        $query->when($slug, function (Builder $query) use ($slug) {
            $query->whereHas('outlet', function (Builder $query) use ($slug) {
                $query->where('slug', $slug);
            });
        });
    }
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
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
