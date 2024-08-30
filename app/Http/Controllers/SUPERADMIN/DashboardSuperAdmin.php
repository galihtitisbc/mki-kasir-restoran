<?php

namespace App\Http\Controllers\SUPERADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardSuperAdmin extends Controller
{
    public function index()
    {
        return view('superadmin.home', [
            'title' =>  'Dashboard'
        ]);
    }
}
