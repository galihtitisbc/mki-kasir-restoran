<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Outlet;
use App\Models\User;
use App\Trait\UserAndRoleLoggedIn;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use UserAndRoleLoggedIn;
    public function index(Request $request)
    {
        $slugQuery = $request->query('outlet');
        $user = $this->getSupervisorOrAdmin();
        $category = $user->outletHasCategory()->categoryByOutlet($slugQuery)->get();
        $outlet = $user->supervisorHasOutlets()->get();
        return view('category.index', [
            'title' =>  'Kategori',
            'kategori'  => $category,
            'outlet'    => $outlet
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required',
            'outlet'        => 'required'
        ]);
        try {
            DB::transaction(function () use ($validated) {
                $outlet = Outlet::where('slug', '=', $validated['outlet'])->first();
                $outlet->categories()->create($validated);
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
            'category_name' => 'required|max:60',
        ]);
        try {
            $category->update($validated);
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
