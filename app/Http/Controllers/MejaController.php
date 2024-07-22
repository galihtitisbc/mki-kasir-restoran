<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MejaController extends Controller
{
    public function index(Request $request)
    {
        $outletQuery = $request->query('outlet');
        $outlet = Outlet::where('supervisor_id', Auth::getUser()->user_id)->get();
        $meja = Meja::cariMeja($outletQuery)->get();
        return view('meja.index', [
            'title' => 'Outlet',
            'data'  => $meja,
            'outlet' => $outlet
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'outlet_slug' => 'required',
        ]);
        $outlet = Outlet::where('slug', $validated['outlet_slug'])->first();
        $meja = Meja::where('outlet_id', $outlet['outlet_id'])->count();
        try {
            $outlet->mejas()->create([
                'nomor_meja' => $meja + 1
            ]);
            return redirect('/home/meja')->with('status', 'Berhasil Tambah Meja');
        } catch (\Throwable $e) {
            dd($e);
            return redirect('/home/meja')->with('error', 'Gagal Tambah Meja');
        }
    }
}
