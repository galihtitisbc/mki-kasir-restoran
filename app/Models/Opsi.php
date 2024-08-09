<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opsi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
    public function detailOpsi()
    {
        return $this->hasMany(DetailOpsi::class, 'opsi_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'detail_opsis', 'opsi_id', 'product_id');
    }
}
