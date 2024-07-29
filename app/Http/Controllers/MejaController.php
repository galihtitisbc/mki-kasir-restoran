<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Outlet;
use App\Models\User;
use App\Trait\GetOutletByUser;
use App\Trait\UserAndRoleLoggedIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MejaController extends Controller
{
    use UserAndRoleLoggedIn, GetOutletByUser;
    public function index(Request $request)
    {
        $slugQuery = $request->query('outlet');
        $meja = Meja::mejaByOutlet($slugQuery)->get();
        return view('meja.index', [
            'title' => 'Outlet',
            'data'  => $meja,
            'outlet' => $this->getOutletByUser()
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
            return redirect('/dashboard/meja')->with('status', 'Berhasil Tambah Meja');
        } catch (\Throwable $e) {
            dd($e);
            return redirect('/dashboard/meja')->with('error', 'Gagal Tambah Meja');
        }
    }
}
