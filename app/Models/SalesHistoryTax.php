<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesHistoryTax extends Model
{
    use HasFactory;
    protected $table = 'sales_history_taxs';
    protected $primaryKey = 'sales_history_tax_id';
}
