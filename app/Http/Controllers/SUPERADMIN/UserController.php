<?php

namespace App\Http\Controllers\SUPERADMIN;

use DB;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PemilikRestoCreateRequest;
use App\Models\User;
use Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserController extends Controller
{
    public function create()
    {
        return view('superadmin.pemilik-outlet.create-pemilik', [
            'title'     =>  'Tambah'
        ]);
    }
    public function store(PemilikRestoCreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validated();
            $validated['password'] = Hash::make($validated['password']);
            $validated['phone'] = $validated['no_hp'];
            $validated['is_active'] = true;
            $user = User::create($validated);
            $user->assignRole('SUPERVISOR');
            DB::commit();
            return redirect('dashboard/superadmin/pemilik-outlet')->with('status', 'Suksess Tambah Pemilik Resto');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect('dashboard/superadmin/pemilik-outlet')->with('error', 'Gagal Tambah Pemilik Resto ');
        };
    }
    public function changeStatus(User $user)
    {
        try {
            $user->update([
                'is_active' =>  !$user->is_active
            ]);
            return response()->json(['message' => 'sukes']);
        } catch (\Throwable $e) {
            throw new BadRequestException($e->getMessage());
        }
    }
}
