<?php

namespace App\Http\Controllers;

use App\Http\Requests\PegawaiRequest;
use App\Http\Requests\PegawaiUpdateRequest;
use App\Models\User;
use App\Trait\UserAndRoleLoggedIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    use UserAndRoleLoggedIn;
    public function index()
    {
        $user = $this->getSupervisorOrAdmin();
        $pegawai = $user->supervisorHasPegawai()->with('outletWorks')->get();
        return view('pegawai.index', [
            'title' => 'Pegawai',
            'pegawais' => $pegawai
        ]);
    }
    public function tambahPegawai()
    {
        $role = DB::table('roles')->whereNotBetween('id', [1, 2])->get('name');
        $outlet = $this->getSupervisorOrAdmin()->supervisorHasOutlets()->get();
        return view('pegawai.tambah', [
            'title'     => 'Tambah Pegawai',
            'role'      => $role,
            'outlet'    => $outlet
        ]);
    }
    public function storePegawai(PegawaiRequest $request)
    {
        $validated = $request->validated();
        $validated['supervisor_id'] = $this->getSupervisorOrAdmin()->user_id;
        $validated['password'] = Hash::make($validated['password']);
        $validated['phone'] = $validated['no_hp'];
        try {
            DB::transaction(function () use ($validated) {
                $user = User::create($validated);
                $user->assignRole($validated['role']);
                $user->outletWorks()->attach($validated['outlet']);
            });
            return redirect('/dashboard/pegawai')->with('status', 'Berhasil Tambah Pegawai');
        } catch (\Throwable $th) {
            return redirect('/dashboard/pegawai')->with('error', 'Gagal Tambah Pegawai');
        }
    }
    public function edit(User $user)
    {
        $role = DB::table('roles')->whereNotBetween('id', [1, 2])->get('name');
        $outlet = $this->getSupervisorOrAdmin()->supervisorHasOutlets()->get();
        $selectedOutlet = $user->outletWorks->pluck('outlet_id')->toArray();
        return view('pegawai.edit', [
            'title'             => 'Edit Pegawai',
            'data'              => $user,
            'role'              => $role,
            'outlet'            => $outlet,
            'selectedOutlet'    => $selectedOutlet
        ]);
    }
    public function update(User $user, PegawaiUpdateRequest $request)
    {
        $validated = $request->validated();
        if ($validated['password'] == null) {
            unset($validated['password']);
        }
        try {
            DB::transaction(function () use ($validated, $user) {
                $user->update($validated);
                $user->syncRoles($validated['role']);
                $user->outletWorks()->sync($validated['outlet']);
            });
            return redirect('/dashboard/pegawai')->with('status', 'Berhasil Edit Pegawai');
        } catch (\Throwable $th) {
            return redirect('/dashboard/pegawai')->with('error', 'Gagal Tambah Pegawai');
        }
    }
    public function hapus(User $user)
    {
        $user->delete();
        return redirect('/dashboard/pegawai')->with('status', 'Berhasil Hapus Pegawai');
    }
}
