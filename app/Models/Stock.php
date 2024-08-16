<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['stock_id'];
    protected $primaryKey = 'stock_id';
    protected static function booted()
    {
        static::addGlobalScope('latest', function ($query) {
            $query->orderBy('created_at', 'desc');
        });
    }
    public function scopeStockByOutlet(Builder $query, array $data)
    {
        $query->whereHas('bahan.outlets', function ($query) use ($data) {
            $query->when($data['outlet'] ?? null, function ($query) use ($data) {
                return $query->where('slug', $data['outlet']);
            });
        });
        $query->when($data['fromDate'], function ($query) use ($data) {
            return $query->where('created_at', '>=', $data['fromDate']);
        });
        $query->when($data['toDate'], function ($query) use ($data) {
            $toDate = Carbon::parse($data['toDate'])->endOfDay();
            return $query->where('created_at', '<=', $toDate);
        });
    }
    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'bahan_id');
    }
}
