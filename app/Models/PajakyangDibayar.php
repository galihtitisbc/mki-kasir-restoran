<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PajakyangDibayar extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function historyPajak()
    {
        return $this->belongsTo(HistoryBayarPajak::class);
    }
}
