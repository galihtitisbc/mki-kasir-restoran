<?php

namespace App\Http\Controllers;

use App\Models\SatuanBahan;
use Illuminate\Http\Request;

class SatuanBahanController extends Controller
{
    public function getSatuanBahan(Request $request)
    {
        $validated = $request->validate([
            'outlet_id' => 'required|array',
            'outlet_id.*' => 'integer|exists:outlets,outlet_id',
        ]);
        $satuan = SatuanBahan::whereIn('outlet_id', $validated['outlet_id'])->get();
        return response()->json([
            'data'  =>  $satuan
        ]);
    }
    public function storeSatuan(Request $request)
    {
        $validated = $request->validate([
            'outlet_id' => 'integer|exists:outlets,outlet_id',
            'satuan'    =>  'required'
        ]);
        SatuanBahan::create($validated);
        return response()->json([
            'message'   =>  'Sukses'
        ]);
    }
}
