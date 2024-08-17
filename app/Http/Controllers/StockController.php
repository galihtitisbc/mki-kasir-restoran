<?php

namespace App\Http\Controllers;

use App\Http\Requests\SesuaikanStockRequest;
use App\Models\Bahan;
use App\Models\Outlet;
use App\Models\Stock;
use App\Trait\GetOutletByUser;
use DB;
use Illuminate\Http\Request;

class StockController extends Controller
{
    use GetOutletByUser;
    public function index(Request $request)
    {
        // $slug = $request->query('outlet');
        // $outlet = $this->getOutletByUser();
        // $stock = Stock::with('bahan')->stockByOutlet($slug)->get();
        // dump($stock);
        return view('stock.index', [
            'title' => 'Stok',
            // 'outlet' => $outlet,
        ]);
    }
    public function sesuaikan(Request $request)
    {
        $slug = $request->query('outlet');
        $outlet = $this->getOutletByUser();
        $bahan = Bahan::bahanByOutlet($slug)->get();
        return view('stock.sesuaikan', [
            'title' => 'Stok',
            'outlet' => $outlet,
            'bahan' => $bahan
        ]);
    }
    public function update(SesuaikanStockRequest $request)
    {
        $validated = collect($request->validated());

        try {
            DB::transaction(function () use ($validated) {
                $shift = $validated['shift'];
                $bahanId = $validated->get('bahan_id');
                $stockMasuk = $validated->get('stock_masuk');
                $stockKeluar = $validated->get('stock_keluar');
                $stockData = collect($bahanId)->map(function ($bahanId, $index) use ($stockMasuk, $stockKeluar, $shift) {
                    return [
                        'shift' => $shift,
                        'bahan_id' => $bahanId,
                        'stock_masuk' => $stockMasuk[$index],
                        'stock_keluar' => $stockKeluar[$index]
                    ];
                });
                $bahanIds = $stockData->pluck('bahan_id')->toArray();
                $bahans = Bahan::whereIn('bahan_id', $bahanIds)->get()->keyBy('bahan_id');

                foreach ($stockData as $value) {
                    $bahan = $bahans[$value['bahan_id']];
                    $bahan->stock = ($bahan->stock + $value['stock_masuk'] ?? 0) - $value['stock_keluar'] ?? 0;
                    $bahan->save();
                }
                Stock::insert($stockData->filter(function ($item) {
                    return !($item['stock_keluar'] === null && $item['stock_masuk'] === null);
                })->map(function ($item) {
                    $item['created_at'] = now();
                    $item['updated_at'] = now();
                    return $item;
                })->toArray());
            });
            return redirect('/dashboard/stock')->with('status', 'Berhasil Sesuaikan Stok');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect('/dashboard/stock')->with('error', 'Gagal Menyesuaikan Stock. message ' . $th->getMessage());
        }
    }
}
