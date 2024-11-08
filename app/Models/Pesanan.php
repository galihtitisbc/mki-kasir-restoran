<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanans';
    protected $primaryKey = 'pesanan_id';
    protected $guarded = ['pesanan_id'];
    protected static function booted()
    {
        static::addGlobalScope('latest', function ($query) {
            $query->orderBy('created_at', 'desc');
        });
    }
    public function salesHistories()
    {
        return $this->hasMany(SalesHistory::class, 'pesanan_id');
    }
    public function product()
    {
        return $this->belongsToMany(Product::class, 'pesanan_product', 'pesanan_id', 'product_id')->withPivot('qty', 'harga', 'total');
    }
    public function meja()
    {
        return $this->belongsTo(Meja::class, 'meja_id');
    }
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'outlet_id');
    }
}
