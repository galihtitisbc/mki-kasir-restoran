<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOpsi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function opsi()
    {
        return $this->belongsTo(Opsi::class, 'opsi_id');
    }
}
