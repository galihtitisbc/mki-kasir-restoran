<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanBahan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
}
