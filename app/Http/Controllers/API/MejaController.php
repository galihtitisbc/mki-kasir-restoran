<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DetailMejaPesananResource;
use App\Http\Resources\MejaResource;
use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $outlet)
    {
        try {
            $meja = Meja::with('pesanans')->mejaByOutlet($outlet)->get();
            return response()->json([
                'message'           => 'Sukses',
                'meja'              => MejaResource::collection($meja)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 401,
                'message' => $th->getMessage()
            ]);
        }
    }
    public function detailMejaTerpesan(Meja $meja)
    {
        try {
            $meja->load('pesanans');
            return response()->json([
                'message'           => 'Sukses',
                'meja_id'       => $meja->meja_id,
                'nomor_meja'    => $meja->nomor_meja,
                'status_meja'   => $meja->status_meja,
                'pesanan'       => DetailMejaPesananResource::collection($meja->pesanans)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 401,
                'message' => $th->getMessage()
            ]);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
