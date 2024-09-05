<?php

namespace App\Http\Controllers\SUPERADMIN;

use App\Models\User;
use App\Models\Outlet;
use App\Models\SalesHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Database\Eloquent\Builder;

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
    public function detailOutlet($slug)
    {
        $outlet = Outlet::with(['products', 'products.salesHistories', 'outletHasPegawai', 'categories'])->where('slug', $slug)->firstOrFail();
        $pegawai = $outlet->with('outletHasPegawai');
        $transaksiBulanIni = SalesHistory::whereHas('outlet', function (Builder $query) use ($slug) {
            $query->where('slug', $slug);
        })
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->get();

        $terlaris = SalesHistory::whereHas('outlet', function (Builder $query) use ($slug) {
            $query->where('slug', $slug);
        })
            ->select('product_name', DB::raw('SUM(quantity) as terjual'))
            ->groupBy('product_name')
            ->orderBy('terjual', 'desc')
            ->first();

        return view('superadmin.outlet.detail-outlet', [
            'title'                 =>  'Detail Outlet',
            'outlet'                =>  $outlet,
            'transaksiBulanIni'     =>  $transaksiBulanIni->count(),
            'terlaris'              => $terlaris
        ]);
    }
}
