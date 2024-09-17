<?php

namespace App\Http\Controllers;

use App\Http\Requests\BahanProductRequest;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Outlet;
use App\Models\Product;
use App\Trait\GetOutletByUser;
use App\Trait\UserAndRoleLoggedIn;
use Auth;
use DB;
use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;
use Storage;

class ProductController extends Controller
{
    use UserAndRoleLoggedIn, GetOutletByUser;
    public function index(Request $request)
    {
        $slugQuery = $request->query('outlet');
        $userFilter = [
            'role'      => Auth::user()->roles->pluck('name')[0],
            'user_id'   => Auth::user()->user_id
        ];
        $produk = Product::with('bahans')->productByOutlet($slugQuery, $userFilter)->paginate(10)->withQueryString();
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
                if (isset($validated['gambar'])) {
                    $fileName = $validated['gambar']->hashName();
                    Storage::putFileAs('public/gambar', $validated['gambar'], $fileName);
                }
                $productCount = Product::orderBy('product_id', 'desc')->first();
                $productCode = 'PRD' . str_pad($productCount->product_id + 1, 3, '0', STR_PAD_LEFT);

                $dns1d = new DNS1D();
                $barcodeName = "{$productCode}.png";
                $barcodeData = $dns1d->getBarcodePNG("{$productCode}", "C39");
                Storage::put("public/barcode/{$barcodeName}", base64_decode($barcodeData));
                $produk = Product::create([
                    'user_id'       =>  Auth::getUser()->user_id,
                    'product_name'  => $validated['product_name'],
                    'price'         => $validated['price'],
                    'gambar'        => $fileName ?? null,
                    'product_code'  => $productCode,
                    'barcode'       => $barcodeName,
                    'stock'         =>  $validated['stock'] ?? null,
                    'is_food'       =>  $validated['is_food'] == 0 ? false : true
                ]);
                $produk->categories()->attach($validated['category_id']);
                $produk->outlets()->attach($validated['outlet_id']);
                if (isset($validated['opsi_id'])) {
                    $produk->opsi()->attach($validated['opsi_id']);
                }
            });
            return redirect('/dashboard/produk')->with('status', 'success');
        } catch (\Throwable $e) {
            dd($e->getMessage());
            return redirect('/dashboard/produk')->with('status', 'error');
        }
    }
    public function edit(Product $product)
    {
        $outlet = $this->getRole() == 'ADMIN'
            ? Auth::user()->outletWorks()->with(['categories', 'opsi.detailOpsi'])->get()
            : Auth::user()->supervisorHasOutlets()->with(['categories', 'opsi.detailOpsi'])->get();
        $category = $outlet->flatMap->categories;
        $opsi = $outlet->flatMap->opsi;
        $selectedCategory = $product->categories->pluck('category_id', 'category_name', 'slug')->toArray();
        $selectedOutlet = $product->outlets->pluck('outlet_id', 'outlet_name', 'slug')->toArray();
        $selectedOpsi = $product->opsi->pluck('id', 'opsi_name')->toArray();
        return view('product.edit', [
            'title'             => 'Update Produk',
            'produk'            => $product,
            'selectedCategory'  => $selectedCategory,
            'selectedOutlet'    => $selectedOutlet,
            'selectedOpsi'     => $selectedOpsi,
            'outlet'            => $outlet,
            'category'          => $category,
            'opsi'              => $opsi
        ]);
    }
    public function update(Product $product, ProductUpdateRequest $request)
    {
        $validated = $request->validated();
        try {
            DB::transaction(function () use ($validated, $product) {
                $updateData = [
                    'product_name'  => $validated['product_name'],
                    'price'         => $validated['price'],
                    'stock'         =>  $validated['stock'] ?? null,
                    'is_food'       =>  $validated['is_food'] == 0 ? false : true

                ];
                if (isset($validated['gambar'])) {
                    $fileName = $validated['gambar']->hashName();
                    Storage::putFileAs('public/gambar', $validated['gambar'], $fileName);
                    Storage::delete('public/gambar/' . $product->gambar);
                    $updateData['gambar'] = $fileName;
                }
                $product->update($updateData);
                $product->categories()->sync($validated['category_id']);
                $product->outlets()->sync($validated['outlet_id']);
                if (isset($validated['opsi_id'])) {
                    $product->opsi()->sync($validated['opsi_id']);
                }
            });
            return redirect('/dashboard/produk')->with('status', 'success');
        } catch (\Throwable $e) {
            return redirect('/dashboard/produk')->with('status', 'error');
        }
    }
    public function updateStatus(Product $product)
    {
        try {
            $product->update([
                'status'    =>  !$product->status
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
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect('/dashboard/produk')->with('status', 'Berhasil Hapus produk');
        } catch (\Throwable $e) {
            return redirect('/dashboard/produk')->with('error', 'Gagal Hapus produk. message ' . $e->getMessage());
        }
    }
    public function tambahBahan(Product $product)
    {
        $product->load('outlets');
        $outletId = $product->outlets->pluck('outlet_id');
        $outlet = Outlet::with('bahans')->whereIn('outlet_id', $outletId)->get();
        $bahan = $outlet->pluck('bahans')->flatten()->unique('bahan_id');
        return view('bahan.bahan-product', [
            'title'     =>  'Bahan Product',
            'product'   =>  $product,
            'bahan'     =>  $bahan
        ]);
    }
    public function storeBahanProduct(Product $product, BahanProductRequest $request)
    {
        $validated = $request->validated();
        try {
            DB::beginTransaction();
            $bahanData = [];
            foreach ($validated['bahan_id'] as $index => $value) {
                $bahanData[] = [
                    'bahan_id'      =>  $value,
                    'qty'           =>  $validated['takaran'][$index],
                    'satuan_bahan'  =>  $validated['satuan_bahan'][$index],
                ];
            }
            $product->bahans()->attach($bahanData);
            DB::commit();
            return redirect('/dashboard/produk')->with('status', 'success');
        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect('/dashboard/produk')->with('status', 'error');
        }
    }
}
