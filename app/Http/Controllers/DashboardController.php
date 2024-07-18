<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:SUPERVISOR|SUPERADMIN']);
    }
    public function index()
    {
        return view('dashboard.home');
    }
}
