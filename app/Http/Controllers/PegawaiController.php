<?php

namespace App\Http\Controllers;

use App\Http\Requests\PegawaiRequest;
use App\Http\Requests\PegawaiUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = User::where('supervisor_id', Auth::user()->user_id)->get();
        return view('pegawai.index', [
            'title' => 'Pegawai',
            'pegawais' => $pegawai
        ]);
    }
    public function tambahPegawai()
    {
        $role = DB::table('roles')->whereNotBetween('id', [1, 2])->get('name');
        return view('pegawai.tambah', [
            'title' => 'Tambah Pegawai',
            'role' => $role
        ]);
    }
    public function storePegawai(PegawaiRequest $request)
    {
        $validated = $request->validated();
        $validated['supervisor_id'] = Auth::user()->user_id;
        $validated['password'] = Hash::make($validated['password']);
        $validated['phone'] = $validated['no_hp'];
        try {
            $user = User::create($validated);
            $user->assignRole($validated['role']);
            return redirect('/home/pegawai')->with('status', 'Berhasil Tambah Pegawai');
        } catch (\Throwable $th) {
            return redirect('/home/pegawai')->with('error', 'Gagal Tambah Pegawai');
        }
    }
    public function edit(User $user)
    {
        $role = DB::table('roles')->whereNotBetween('id', [1, 2])->get('name');
        return view('pegawai.edit', [
            'title' => 'Edit Pegawai',
            'data'  => $user,
            'role'  => $role
        ]);
    }
    public function update(User $user, PegawaiUpdateRequest $request)
    {
        $validated = $request->validated();
        if ($validated['password'] == null) {
            unset($validated['password']);
        }
        try {
            $user->update($validated);
            $user->syncRoles($validated['role']);
            return redirect('/home/pegawai')->with('status', 'Berhasil Edit Pegawai');
        } catch (\Throwable $th) {
            return redirect('/home/pegawai')->with('error', 'Gagal Tambah Pegawai');
        }
    }
    public function hapus(User $user)
    {
        $user->delete();
        return redirect('/home/pegawai')->with('status', 'Berhasil Hapus Pegawai');
    }
}
