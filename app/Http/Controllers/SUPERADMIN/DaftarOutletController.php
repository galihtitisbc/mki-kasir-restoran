<?php

namespace App\Http\Controllers\SUPERADMIN;

use DB;
use App\Models\User;
use App\Models\Outlet;
use App\Models\SalesHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\HistoryBayarPajak;
use App\Http\Controllers\Controller;
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
    public function semuaOutlet()
    {
        return view('superadmin.outlet.seluruh-outlet', [
            'title'     =>  'Daftar Outlet',
        ]);
    }
    public function daftarOutlet($email)
    {
        $user = User::where('email', $email)
            ->with(['supervisorHasOutlets' => function ($query) {
                $query->withCount(['salesHistories' => function ($query) {
                    $query->whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year);
                }]);
            }])
            ->first();
        return view('superadmin.outlet.daftar-outlet', [
            'title'     =>  'Daftar Outlet',
            'user'      =>  $user
        ]);
    }
    public function detailOutlet($slug)
    {
        $outlet = Outlet::with(['products', 'supervisor', 'products.salesHistories', 'outletHasPegawai', 'categories'])->where('slug', $slug)->firstOrFail();
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
        $riwayatPajak = HistoryBayarPajak::with('pajakYangDibayar')
            ->whereHas('outlet', function (Builder $query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        return view('superadmin.outlet.detail-outlet', [
            'title'                 =>  'Detail Outlet',
            'outlet'                =>  $outlet,
            'transaksiBulanIni'     =>  $transaksiBulanIni->count(),
            'terlaris'              =>  $terlaris,
            'riwayatPajak'          =>  $riwayatPajak
        ]);
    }
}
