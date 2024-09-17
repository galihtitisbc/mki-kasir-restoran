<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Trait\GetOutletByUser;
use App\Trait\UserAndRoleLoggedIn;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PegawaiRequest;
use App\Http\Requests\PegawaiUpdateRequest;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class PegawaiController extends Controller
{
    use UserAndRoleLoggedIn, GetOutletByUser;
    public function index(Request $request)
    {
        $slugQuery = $request->query('outlet');
        $pegawai = User::with('outletWorks')->pegawaiByOutlet($slugQuery)->get();
        return view('pegawai.index', [
            'title'     => 'Pegawai',
            'pegawais'  => $pegawai,
            'outlet'    => $this->getOutletByUser()
        ]);
    }
    public function tambahPegawai()
    {
        $role = DB::table('roles')->whereNotBetween('id', [1, 2])->get('name');
        return view('pegawai.tambah', [
            'title'     => 'Tambah Pegawai',
            'role'      => $role,
            'outlet'    => $this->getOutletByUser()
        ]);
    }
    public function storePegawai(PegawaiRequest $request)
    {
        $validated = $request->validated();
        $validated['supervisor_id'] = $this->getSupervisor()->user_id;
        $validated['password'] = Hash::make($validated['password']);
        $validated['phone'] = $validated['no_hp'];
        try {
            if (in_array($validated['role'], ['DAPUR', 'KASIR'])) {
                if (count($validated['outlet']) > 1) {
                    return redirect()->back()->withInput()->with('error', 'Role KASIR dan DAPUR Hanya Boleh 1 Outlet');
                }
            }
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
        $selectedOutlet = $user->outletWorks->pluck('outlet_id')->toArray();
        return view('pegawai.edit', [
            'title'             => 'Edit Pegawai',
            'data'              => $user,
            'role'              => $role,
            'outlet'            => $this->getOutletByUser(),
            'selectedOutlet'    => $selectedOutlet
        ]);
    }
    public function update(User $user, PegawaiUpdateRequest $request)
    {
        $validated = $request->validated();
        if ($validated['password'] == null) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
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
    public function changeStatus(User $user)
    {
        try {
            if ($user->user_id == Auth::user()->user_id) {
                throw new BadRequestException("Bad Request");
            }
            $user->update([
                'is_active' =>  !$user->is_active
            ]);
            return response()->json(['message' => 'sukes']);
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage());
        }
    }
    public function hapus(User $user)
    {
        $user->delete();
        return redirect('/dashboard/pegawai')->with('status', 'Berhasil Hapus Pegawai');
    }
}
