<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Models\Product;
use App\Trait\UserAndRoleLoggedIn;
use Auth;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use UserAndRoleLoggedIn;
    public function index(Request $request)
    {
        $slugQuery = $request->query('outlet');
        $outlet = '';
        $outlet = $this->getSupervisorOrAdmin()->supervisorHasOutlets()->get();
        // $outlet = $this->getSupervisorOrAdmin()->supervisorHasPegawai(); if admin role
        // dd($outlet);
        $produk = Product::productByOutlet($slugQuery)->get();
        return view('product.index', [
            'title'     =>  'Kelola Produk',
            'product'   => $produk,
            'outlet'    => $outlet
        ]);
    }
    public function tambah()
    {
        $outlet = $this->getSupervisorOrAdmin()->supervisorHasOutlets()->get();
        $category = $this->getSupervisorOrAdmin()->outletHasCategory()->get();
        return view('product.tambah', [
            'title'     =>  'Tambah Produk',
            'outlet'    => $outlet,
            'category'  => $category
        ]);
    }
    public function store(ProductCreateRequest $request)
    {
        $validated = $request->validated();
        $validated['gambar'] = 'test';
        try {
            DB::transaction(function () use ($validated) {
                $produk = Product::create([
                    'user_id'       =>  Auth::getUser()->user_id,
                    'supplier_id'   => $validated['supplier_id'],
                    'product_name'  => $validated['product_name'],
                    'price'         => $validated['price'],
                    'stock'         => $validated['stock'],
                    'gambar'        => $validated['gambar']
                ]);
                $produk->categories()->attach($validated['category_id']);
                $produk->outlets()->attach($validated['outlet_id']);
            });
            return redirect('/dashboard/produk')->with('status', 'Berhasil Tambah produk');
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return redirect('/dashboard/produk')->with('error', 'Gagal Tambah produk. message ' . $e->getMessage());
        }
    }
}
