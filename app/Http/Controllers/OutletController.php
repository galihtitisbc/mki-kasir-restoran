<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outlet = Auth::getUser()->supervisorHasOutlets()->get();
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
            'outlet_name' => 'required|unique:outlets,outlet_name|max:60|string',
            'address'   => 'required',
            'phone'     => 'required|numeric|min:5'
        ]);
        $validated['slug'] = Str::slug($validated['outlet_name']);
        try {
            $user = Auth::getUser();
            $user->supervisorHasOutlets()->create($validated);
            return redirect('/home/outlet')->with('status', 'Berhasil Tambah Outlet');
        } catch (\Throwable $e) {
            dd($e);
            return redirect('/home/outlet')->with('error', 'Gagal Tambah Outlet');
        }
    }
    public function update(Request $request, Outlet $outlet)
    {
        $validated = $request->validate([
            'outlet_name' => 'required|max:60|string',
            'address'   => 'required',
            'phone'     => 'required|numeric|min:5'
        ]);
        $validated['slug'] = Str::slug($validated['outlet_name']);
        try {
            $outlet->update($validated);
            return redirect('/home/outlet')->with('status', 'Berhasil Edit Outlet');
        } catch (\Throwable $e) {
            return redirect('/home/outlet')->with('error', 'Gagal Edit Outlet');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outlet $outlet)
    {
        try {
            $outlet->delete();
            return redirect('/home/outlet')->with('status', 'Berhasil Hapus Outlet');
        } catch (\Throwable $e) {
            return redirect('/home/outlet')->with('error', 'Gagal Hapus Outlet');
        }
    }
}
