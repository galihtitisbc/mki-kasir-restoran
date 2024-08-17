<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Supplier;
use App\Trait\GetOutletByUser;
use App\Trait\UserAndRoleLoggedIn;
use Auth;
use DB;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    use UserAndRoleLoggedIn, GetOutletByUser;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $slug = $request->query('outlet');
        $userFilter = [
            'role'      => Auth::user()->roles->pluck('name')[0],
            'user_id'   => Auth::user()->user_id
        ];
        $supplier = Supplier::with('outlets')->supplierByOutlet($slug, $userFilter)->get();
        return view('supplier.index', [
            'title' => 'Supplier',
            'supplier' => $supplier,
            'outlet' => $this->getOutletByUser()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'outlet_id' => 'required|array',
            'outlet_id.*' => 'required|exists:outlets,outlet_id',
        ]);
        try {
            DB::transaction(function () use ($validated) {
                $validated['user_id'] = Auth::getUser()->user_id;
                $supplier = Supplier::create($validated);
                $supplier->outlets()->attach($validated['outlet_id']);
            });
            return redirect('/dashboard/supplier')->with('status', 'success');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect('/dashboard/supplier')->with('status', 'error');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $validated = $request->validate([
            'supplier_name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'outlet_id' => 'required|array',
            'outlet_id.*' => 'required|exists:outlets,outlet_id',
        ]);
        try {
            DB::transaction(function () use ($validated, $slug) {
                $supplier = Supplier::where('slug', $slug)->first();
                $supplier->update($validated);
                $supplier->outlets()->sync($validated['outlet_id']);
            });
            return redirect('/dashboard/supplier')->with('status', 'success');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect('/dashboard/supplier')->with('status', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $supplier = Supplier::where('slug', $slug)->first();
        $supplier->delete();
        return redirect('/dashboard/supplier')->with('status', 'success');
    }
}
