<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOutlet extends Model
{
    use HasFactory;
    protected $table = 'user_outlets';
    protected $primaryKey = 'user_outlet_id';
    protected $guarded = ['user_outlet_id'];
    public $timestamps = false;
}
