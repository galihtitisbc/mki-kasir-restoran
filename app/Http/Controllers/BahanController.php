<?php

namespace App\Http\Controllers;

use App\Http\Requests\BahanCreateRequest;
use App\Http\Requests\BahanUpdateRequest;
use App\Models\Bahan;
use App\Models\Supplier;
use App\Trait\GetOutletByUser;
use Auth;
use DB;
use Illuminate\Http\Request;

class BahanController extends Controller
{
    use GetOutletByUser;

    private function getOutletsWithSuppliers()
    {
        $user = Auth::getUser();
        $outletRelation = $this->getRole() == 'ADMIN' ? 'outletWorks' : 'supervisorHasOutlets';

        $outlets = $user->$outletRelation()->with('suppliers')->get();
        $suppliers = $outlets->flatMap->suppliers;

        return [$outlets, $suppliers];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $slug = $request->query('outlet');
        $outlet = $this->getOutletByUser();
        $bahan = Bahan::bahanByOutlet($slug)->get();
        return view('bahan.index', [
            'title' => 'Bahan',
            'bahan' => $bahan,
            'outlet' => $outlet
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        [$outlet, $suppliers] = $this->getOutletsWithSuppliers();

        return view('bahan.create', [
            'title' => 'Bahan Tambah',
            'outlet' => $outlet,
            'supplier' => $suppliers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BahanCreateRequest $request)
    {
        $validated = $request->validated();
        try {
            DB::transaction(function () use ($validated) {
                $validated['harga_bahan_keseluruhan'] = $validated['stock'] * $validated['harga_bahan_per_satuan'];
                $bahan = Bahan::create($validated);
                $bahan->suppliers()->associate($validated['supplier_id'])->save();
                $bahan->outlets()->attach($validated['outlet_id']);
            });
            return redirect('/dashboard/bahan')->with('status', 'Berhasil Tambah Bahan');
        } catch (\Throwable $e) {
            dd($e);
            return redirect('/dashboard/bahan')->with('error', 'Gagal Tambah Bahan');
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bahan = Bahan::where('slug', $id)->first();
        [$outlet, $suppliers] = $this->getOutletsWithSuppliers();
        $selectedOutlet = $bahan->outlets->pluck('outlet_id')->toArray();
        return view('bahan.edit', [
            'title' => 'Bahan Edit',
            'bahan' => $bahan,
            'outlet' => $outlet,
            'supplier' => $suppliers,
            'selectedOutlet' => $selectedOutlet
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BahanUpdateRequest $request, string $slug)
    {
        $validated = $request->validated();
        try {
            DB::transaction(function () use ($validated, $slug) {
                $bahan = Bahan::where('slug', $slug)->first();
                $validated['harga_bahan_keseluruhan'] = $bahan->stock * $validated['harga_bahan_per_satuan'];
                $bahan->update($validated);
                $bahan->suppliers()->associate($validated['supplier_id'])->save();
                $bahan->outlets()->sync($validated['outlet_id']);
            });
            return redirect('/dashboard/bahan')->with('status', 'Berhasil Edit Bahan');
        } catch (\Throwable $e) {
            dd($e);
            return redirect('/dashboard/bahan')->with('error', 'Gagal Edit Bahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $bahan = Bahan::where('slug', $slug)->first();
        $bahan->delete();
        return redirect('/dashboard/bahan')->with('status', 'Berhasil Hapus Bahan');
    }
}
