<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Outlet;
use App\Trait\GetOutletByUser;
use Illuminate\Http\Request;

class StockController extends Controller
{
    use GetOutletByUser;
    public function index(Request $request)
    {
        $slug = $request->query('outlet');
        $outlet = $this->getOutletByUser();
        $bahan = Bahan::bahanByOutlet($slug)->get();
        dump($bahan);
        return view('stock.index', [
            'title' => 'Stok',
            'outlet' => $outlet,
            'bahan' => $bahan
        ]);
    }
}
