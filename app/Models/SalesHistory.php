<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesHistory extends Model
{
    use HasFactory;
    protected $table = 'sales_histories';
    protected $primaryKey = 'sales_history_id';
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
    public function salesHistoryTax()
    {
        return $this->hasMany(SalesHistoryTax::class, 'sales_history_id');
    }
    public function taxs()
    {
        return $this->belongsToMany(Tax::class, 'sales_history_taxs', 'sales_history_id', 'tax_id');
    }
}
