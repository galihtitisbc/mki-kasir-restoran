<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    protected $table = 'taxs';
    protected $primaryKey = 'tax_id';
    public function salesHistories()
    {
        return $this->belongsToMany(SalesHistory::class, 'sales_history_taxs', 'tax_id', 'sales_history_id');
    }
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
}
