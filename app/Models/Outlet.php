<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    protected $table = 'outlets';
    protected $primaryKey = 'outlet_id';
    public function salesHistories()
    {
        return $this->hasMany(SalesHistory::class, 'outlet_id');
    }
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
    public function taxs()
    {
        return $this->hasMany(Tax::class, 'outlet_id');
    }
    public function mejas()
    {
        return $this->hasMany(Meja::class, 'outlet_id');
    }
}
