<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryBayarPajak extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pajakYangDibayar()
    {
        return $this->hasMany(PajakyangDibayar::class);
    }
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
}
