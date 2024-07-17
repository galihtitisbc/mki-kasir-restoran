<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanans';
    protected $primaryKey = 'pesanan_id';
    public function salesHistories()
    {
        return $this->hasMany(SalesHistory::class, 'pesanan_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function meja()
    {
        return $this->belongsTo(Meja::class, 'meja_id');
    }
}
