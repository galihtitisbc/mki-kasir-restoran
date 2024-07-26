<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\User;
use App\Trait\UserAndRoleLoggedIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OutletController extends Controller
{
    use UserAndRoleLoggedIn;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = $this->getSupervisorOrAdmin();
        $outlet = $user->supervisorHasOutlets()->get();
        return view('outlet.index', [
            'title' => 'Outlet',
            'data'  => $outlet
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'outlet_name' => 'required|max:60',
            'address'   => 'required',
            'phone'     => 'required|numeric|min:5'
        ]);
        try {
            $this->getSupervisorOrAdmin()->supervisorHasOutlets()->create($validated);
            return redirect('/dashboard/outlet')->with('status', 'Berhasil Tambah Outlet');
        } catch (\Throwable $e) {
            dd($e);
            return redirect('/dashboard/outlet')->with('error', 'Gagal Tambah Outlet');
        }
    }
    public function update(Request $request, Outlet $outlet)
    {
        $validated = $request->validate([
            'outlet_name' => 'required|max:60|string',
            'address'   => 'required',
            'phone'     => 'required|numeric|min:5'
        ]);
        try {
            $outlet->update($validated);
            return redirect('/dashboard/outlet')->with('status', 'Berhasil Edit Outlet');
        } catch (\Throwable $e) {
            return redirect('/dashboard/outlet')->with('error', 'Gagal Edit Outlet');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outlet $outlet)
    {
        try {
            $outlet->delete();
            return redirect('/dashboard/outlet')->with('status', 'Berhasil Hapus Outlet');
        } catch (\Throwable $e) {
            return redirect('/dashboard/outlet')->with('error', 'Gagal Hapus Outlet');
        }
    }
}
