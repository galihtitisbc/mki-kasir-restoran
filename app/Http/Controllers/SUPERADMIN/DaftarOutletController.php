<?php

namespace App\Http\Controllers\SUPERADMIN;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DaftarOutletController extends Controller
{
    public function index()
    {
        $pemilikOutlet = User::role('SUPERVISOR')->get();
        return view('superadmin.outlet.pemilik-outlet', [
            'title'     =>  'Pemilik Outlet',
            'users'     =>  $pemilikOutlet
        ]);
    }
    public function daftarOutlet(User $user)
    {
        $user->load('supervisorHasOutlets');
        return view('superadmin.outlet.daftar-outlet', [
            'title'     =>  'Daftar Outlet',
            'user'      =>  $user
        ]);
    }
}
