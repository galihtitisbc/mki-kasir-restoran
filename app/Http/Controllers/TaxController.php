<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Tax;
use Illuminate\Http\Request;
use App\Trait\GetOutletByUser;
use Illuminate\Support\Facades\Auth;

class TaxController extends Controller
{
    use GetOutletByUser;
    public function index(Request $request)
    {
        $slug = $request->query('outlet');
        $tax = Tax::with('outlets')->taxByOutlet($slug)->get();
        return view('pajak.index', [
            'title'     =>  'Pajak',
            'outlet'    =>  $this->getOutletByUser(),
            'tax'       => $tax
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tax_name'      => 'required|max:255',
            'tax_rate'      => 'required|numeric',
            'description'   => 'required',
            'outlet_id'     => 'required|array',
            'outlet.*'      => 'required|numeric|exists:outlets,outlet_id',
        ]);
        try {
            DB::transaction(function () use ($validated) {
                $tax = Tax::create($validated);
                $tax->outlets()->attach($validated['outlet_id']);
            });
            return redirect('/dashboard/pajak')->with('status', 'Berhasil Tambah pajak');
        } catch (\Throwable $e) {
            return redirect('/dashboard/pajak')->with('error', 'Gagal Tambah pajak. message ' . $e->getMessage());
        }
    }
    public function changeStatus(Tax $tax)
    {
        try {
            $tax->update([
                'status'    =>  !$tax->status
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil Update Status produk',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 401,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function destroy($slug)
    {
        try {
            Tax::where('slug', $slug)->delete();
            return redirect('/dashboard/pajak')->with('status', 'Berhasil hapus pajak');
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return redirect('/dashboard/pajak')->with('error', 'Gagal hapus pajak. message ' . $e->getMessage());
        }
    }
    public function update($slug, Request $request)
    {
        $validated = $request->validate([
            'tax_name'      => 'required|max:255',
            'tax_rate'      => 'required|numeric',
            'description'   => 'required',
            'outlet_id'     => 'required|array',
            'outlet.*'      => 'required|numeric'
        ]);
        try {
            DB::transaction(function () use ($validated, $slug) {
                $tax = Tax::where('slug', $slug)->firstOrFail();
                $tax->update($validated);
                $tax->outlets()->sync($validated['outlet_id']);
            });
            return redirect('/dashboard/pajak')->with('status', 'Berhasil Update pajak');
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return redirect('/dashboard/pajak')->with('error', 'Gagal Update pajak. message ' . $e->getMessage());
        }
    }
    public function riwayatBayarPajak()
    {
        return view('pajak.history-bayar-pajak', [
            'title'     =>  'Riwayat Pembayaran'
        ]);
    }
}
