<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;
    protected $table = 'mejas';
    protected $primaryKey = 'meja_id';
    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'meja_id');
    }
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
}
