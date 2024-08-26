<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OutletWorks;
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
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['Email Atau Password Salah'],
                ]);
            }
            $token = $user->createToken($request->email)->plainTextToken;
            $user->load('outletWorks');
            return response()->json([
                'message' => 'Sukses',
                'token' => $token,
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
