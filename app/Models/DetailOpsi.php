<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOpsi extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope('latest', function ($query) {
            $query->orderBy('created_at', 'desc');
        });
    }
    protected $guarded = ['id'];

    public function opsi()
    {
        return $this->belongsTo(Opsi::class, 'opsi_id');
    }
}
