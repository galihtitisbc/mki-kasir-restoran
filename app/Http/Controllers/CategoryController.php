<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Outlet;
use App\Models\User;
use App\Trait\GetOutletByUser;
use App\Trait\UserAndRoleLoggedIn;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use UserAndRoleLoggedIn, GetOutletByUser;
    public function index(Request $request)
    {
        $slugQuery = $request->query('outlet');
        $userFilter = [
            'role'      => Auth::user()->roles->pluck('name')[0],
            'user_id'   => Auth::user()->user_id
        ];
        $category = Category::with('outlet')->categoryByOutlet($slugQuery, $userFilter)->get();
        return view('category.index', [
            'title' =>  'Kategori',
            'kategori'  => $category,
            'outlet'    => $this->getOutletByUser()
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required',
            'outlet_id'     => 'required|array',
            'outlet_id.*'   => 'required|exists:outlets,outlet_id',
        ]);
        dd($validated);
        try {
            DB::transaction(function () use ($validated) {
                $category = Category::create([
                    'category_name' => $validated['category_name'],
                ]);
                $category->outlet()->attach($validated['outlet_id']);
            });
            return redirect('/dashboard/kategori')->with('status', 'Berhasil Tambah Kategori');
        } catch (\Throwable $e) {
            dd($e);
            return redirect('/dashboard/kategori')->with('error', 'Gagal Tambah Kategori');
        }
    }
    public function update(Category $category, Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required',
            'outlet_id'     => 'required|array',
            'outlet_id.*'   => 'required|exists:outlets,outlet_id',
        ]);
        try {
            $category->update([
                'category_name' => $validated['category_name'],
            ]);
            $category->outlet()->sync($validated['outlet_id']);
            return redirect('/dashboard/kategori')->with('status', 'Berhasil Edit Kategori');
        } catch (\Throwable $e) {
            return redirect('/dashboard/kategori')->with('error', 'Gagal Edit Kategori');
        }
    }
    public function delete(Category $category)
    {
        try {
            $category->delete();
            return redirect('/dashboard/kategori')->with('status', 'Berhasil Hapus Kategori');
        } catch (\Throwable $e) {
            return redirect('/dashboard/kategori')->with('error', 'Gagal Hapus Kategori');
        }
    }
}
