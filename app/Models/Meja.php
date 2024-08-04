<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Meja extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'mejas';
    protected $primaryKey = 'meja_id';
    protected $guarded = ['meja_id'];
    public function scopeMejaByOutlet(Builder $query, $slug = null)
    {
        $query->whereHas('outlet', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }
    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'meja_id');
    }
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
}
