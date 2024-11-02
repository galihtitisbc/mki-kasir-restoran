<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OutletWorks;
use App\Http\Resources\UserAuthResource;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $user = User::where('email', $request->email)->firstOrFail();
            if ($user->is_active == false) {
                throw ValidationException::withMessages([
                    'is_active' => ['Akun Anda Tidak Aktif'],
                ]);
            }
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['Email Atau Password Salah'],
                ]);
            }
            $token = $user->createToken($request->email)->plainTextToken;
            $user->load(['outletWorks', 'roles']);
            return response()->json([
                'message' => 'Sukses',
                'token' => $token,
                'user'  =>  $user->load(['roles']),
                'outlet_kerja' => OutletWorks::collection($user->outletWorks)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal',
                'error' => $e->getMessage(),
            ], 401);
        }
    }
}
