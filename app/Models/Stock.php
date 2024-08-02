<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['stock_id'];
    public function scopeStockByOutlet(Builder $query, $slug)
    {
        $query->whereHas('bahan.outlets', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }
    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'bahan_id');
    }
}
