<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $slugQuery = $request->query('outlet');
        $currentUser = Auth::getUser();
        $category = '';
        if ($currentUser->getRoleNames()->implode(', ') != 'ADMIN') {
            $category = $currentUser->outletHasCategory()->get();
        } else {
            $supervisorFromCurrentUser = User::where('user_id', $currentUser->supervisor_id)->first();
            $category = $supervisorFromCurrentUser->outletHasCategory()->get();
        }
        if ($slugQuery != "" || $slugQuery != null) {
            $category = Category::categoryByOutlet($slugQuery)->get();
        }
        return view('category.index', [
            'title' =>  'Kategori',
            'kategori'  => $category,
            'outlet'    => Outlet::all()
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories,category_name|max:60|string',
        ]);
        $validated['slug'] = Str::slug($validated['category_name']);
        try {
            $user = Auth::getUser();
            $user->categories()->create($validated);
            return redirect('/home/kategori')->with('status', 'Berhasil Tambah Kategori');
        } catch (\Throwable $e) {
            return redirect('/home/kategori')->with('error', 'Gagal Tambah Kategori');
        }
    }
    public function update(Category $category, Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories,category_name|max:60|string',
        ]);
        try {
            $category->update($validated);
            return redirect('/home/kategori')->with('status', 'Berhasil Edit Kategori');
        } catch (\Throwable $e) {
            return redirect('/home/kategori')->with('error', 'Gagal Edit Kategori');
        }
    }
    public function delete(Category $category)
    {
        try {
            $category->delete();
            return redirect('/home/kategori')->with('status', 'Berhasil Hapus Kategori');
        } catch (\Throwable $e) {
            return redirect('/home/kategori')->with('error', 'Gagal Hapus Kategori');
        }
    }
}
