<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use HasFactory, SoftDeletes, Sluggable;
    protected $table = 'taxs';
    protected $primaryKey = 'tax_id';
    protected $guarded = ['tax_id'];
    protected static function booted()
    {
        static::addGlobalScope('latest', function ($query) {
            $query->orderBy('created_at', 'desc');
        });
    }
    public function scopeTaxByOutlet(Builder $query, $slug, array $userFilter)
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
    public function salesHistories()
    {
        return $this->belongsToMany(SalesHistory::class, 'sales_history_taxs', 'tax_id', 'sales_history_id');
    }
    public function outlets()
    {
        return $this->belongsToMany(Outlet::class, 'tax_outlets', 'tax_id', 'outlet_id');
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'tax_name'
            ]
        ];
    }
}
