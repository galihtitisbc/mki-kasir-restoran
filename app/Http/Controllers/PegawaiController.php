<?php

namespace App\Http\Controllers;

use App\Http\Requests\PegawaiRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('pegawai.tambah', [
            'title' => 'Tambah Pegawai',
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
    public function hapus(User $user)
    {
        $user->delete();
        return redirect('/home/pegawai')->with('status', 'Berhasil Hapus Pegawai');
    }
}
