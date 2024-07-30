<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Trait\GetOutletByUser;
use App\Trait\UserAndRoleLoggedIn;
use Auth;
use DB;
use Illuminate\Http\Request;
use Storage;

class ProductController extends Controller
{
    use UserAndRoleLoggedIn, GetOutletByUser;
    public function index(Request $request)
    {
        $slugQuery = $request->query('outlet');
        $produk = Product::productByOutlet($slugQuery)->get();
        return view('product.index', [
            'title'     =>  'Kelola Produk',
            'product'   => $produk,
            'outlet'    => $this->getOutletByUser()
        ]);
    }
    public function tambah()
    {
        $outlet = $this->getRole() == 'ADMIN'
            ? Auth::user()->outletWorks()->with('categories')->get()
            : Auth::user()->supervisorHasOutlets()->with('categories')->get();
        $category = $outlet->flatMap(function ($outlet) {
            return $outlet->categories;
        });

        return view('product.tambah', [
            'title'     =>  'Tambah Produk',
            'outlet'    => $outlet,
            'category'  => $category
        ]);
    }
    public function store(ProductCreateRequest $request)
    {
        $validated = $request->validated();
        try {
            DB::transaction(function () use ($validated) {
                $fileName = $validated['gambar']->hashName();
                Storage::putFileAs('public/gambar', $validated['gambar'], $fileName);
                $produk = Product::create([
                    'user_id'       =>  Auth::getUser()->user_id,
                    'product_name'  => $validated['product_name'],
                    'price'         => $validated['price'],
                    'stock'         => $validated['stock'],
                    'gambar'        => $fileName
                ]);
                $produk->categories()->attach($validated['category_id']);
                $produk->outlets()->attach($validated['outlet_id']);
            });
            return redirect('/dashboard/produk')->with('status', 'Berhasil Tambah produk');
        } catch (\Throwable $e) {
            return redirect('/dashboard/produk')->with('error', 'Gagal Tambah produk. message ' . $e->getMessage());
        }
    }
    public function edit(Product $product)
    {
        $outlet = $this->getRole() == 'ADMIN'
            ? Auth::user()->outletWorks()->with('categories')->get()
            : Auth::user()->supervisorHasOutlets()->with('categories')->get();
        $category = $outlet->flatMap(function ($outlet) {
            return $outlet->categories;
        });
        $selectedCategory = $product->categories->pluck('category_id', 'category_name', 'slug')->toArray();
        $selectedOutlet = $product->outlets->pluck('outlet_id', 'outlet_name', 'slug')->toArray();
        return view('product.edit', [
            'title'             => 'Update Produk',
            'produk'            => $product,
            'selectedCategory'  => $selectedCategory,
            'selectedOutlet'    => $selectedOutlet,
            'outlet'            => $outlet,
            'category'          => $category
        ]);
    }
    public function update(Product $product, ProductUpdateRequest $request)
    {
        $validated = $request->validated();
        try {
            DB::transaction(function () use ($validated, $product) {
                if (isset($validated['gambar'])) {
                    $fileName = $validated['gambar']->hashName();
                    Storage::putFileAs('public/gambar', $validated['gambar'], $fileName);
                    Storage::delete('public/gambar/' . $product->gambar);
                    $product->update([
                        'gambar'    =>  $fileName
                    ]);
                }
                $product->update([
                    'product_name'  => $validated['product_name'],
                    'price'         => $validated['price'],
                    'stock'         => $validated['stock'],
                ]);
                $product->categories()->sync($validated['category_id']);
                $product->outlets()->sync($validated['outlet_id']);
            });
            return redirect('/dashboard/produk')->with('status', 'Berhasil Edit produk');
        } catch (\Throwable $e) {
            return redirect('/dashboard/produk')->with('error', 'Gagal Edit produk. message ' . $e->getMessage());
        }
    }
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect('/dashboard/produk')->with('status', 'Berhasil Hapus produk');
        } catch (\Throwable $e) {
            return redirect('/dashboard/produk')->with('error', 'Gagal Hapus produk. message ' . $e->getMessage());
        }
    }
}
