<?php

namespace App\Models;

use App\Utils\StatusPesanan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesHistory extends Model
{
    use HasFactory;
    protected $table = 'sales_histories';
    protected $primaryKey = 'sales_history_id';
    protected static function booted()
    {
        static::addGlobalScope('latest', function ($query) {
            $query->orderBy('created_at', 'desc');
        });
    }
    public function scopeFilter(Builder $query, array $data)
    {
        $query->whereHas('outlet', function ($query) use ($data) {
            $query->where('slug', $data['outlet']);
        });
        $query->when($data['category'] ?? null, function (Builder $query, $category) {
            $query->whereHas('product', function ($query) use ($category) {
                $query->whereHas('categories', function ($query) use ($category) {
                    $query->where('slug', $category);
                });
            });
        });
        $query->when($data['fromDate'] ?? null, function (Builder $query, $fromDate) {
            $query->whereDate('created_at', '>=', $fromDate);
        });
        $query->when($data['toDate'] ?? null, function (Builder $query, $toDate) {
            $query->whereDate('created_at', '<=', $toDate);
        });
        $query->whereHas('pesanan', function ($query) {
            $query->where('status', StatusPesanan::PAID);
        });
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    public function taxs()
    {
        return $this->belongsToMany(Tax::class, 'sales_history_taxs', 'sales_history_id', 'tax_id')->withPivot('total');
    }
}
