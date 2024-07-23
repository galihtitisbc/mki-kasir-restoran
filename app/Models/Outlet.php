<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outlet extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'outlets';
    protected $primaryKey = 'outlet_id';
    protected $guarded = ['outlet_id'];
    public function salesHistories()
    {
        return $this->hasMany(SalesHistory::class, 'outlet_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_outlets', 'outlet_id', 'user_id');
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
