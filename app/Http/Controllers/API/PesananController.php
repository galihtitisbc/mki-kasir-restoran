<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\Meja;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pesanan;

class PesananController extends Controller
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
        try {
            $validator = Validator::make($request->all(), [
                'meja_id'               => 'required|numeric|exists:mejas,meja_id',
                "nama_pemesan"          => 'required|max:60',
                'product.*.product_id'  => 'required|numeric|exists:products,product_id',
                'product.*.qty'         => 'required|integer|min:1'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Gagal',
                    'error' => $validator->errors(),
                ], 401);
            }
            $validated = $validator->validated();
            $meja = Meja::where('meja_id', $validated['meja_id'])->firstOrFail();
            if ($meja->status_meja == 'TERPESAN') {
                throw new \Exception("Meja Sudah Terpesan", 1);
            }
            $dataPesanan = [];
            foreach ($validated['product'] as $key => $value) {
                $dataPesanan[] = [
                    'meja_id'       => $validated['meja_id'],
                    'product_id'    => $value['product_id'],
                    'quantity'      => $value['qty'],
                    'total'         => $value['qty'] * Product::find($value['product_id'])->price,
                    'nama_pemesan'  => $validated['nama_pemesan'],
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                ];
            }
            Pesanan::insert($dataPesanan);
            $meja->update([
                'status_meja' => 'TERPESAN',
            ]);
            return response()->json([
                'status'    => 'Berhasil',
                'messahe'   => 'Berhasil Tambah Pesanan Pada Meja Nomor ' . $validated['meja_id'],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal',
                'error' => $e->getMessage(),
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
