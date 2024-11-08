<?php

namespace App\Livewire;

use App\Exports\LaporanTransaksi;
use Auth;
use Livewire\Component;
use App\Models\Category;
use App\Models\Outlet;
use App\Models\SalesHistory;
use App\Trait\GetOutletByUser;
use App\Trait\UserAndRoleLoggedIn;
use DB;
use Dompdf\Dompdf;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class LaporanTransaksiIndex extends Component
{
    use GetOutletByUser, UserAndRoleLoggedIn;
    public $outlets;
    public $outletSearch;
    public $fromDate;
    public $toDate;
    public $categories;
    public $categorySearch;
    public $transactions;
    public $productSearch;
    public function mount()
    {
        $this->outlets = $this->getOutletByUser();
    }
    public function render()
    {
        $data = [
            'outlet'        => $this->outletSearch,
            'fromDate'      => $this->fromDate,
            'toDate'        => $this->toDate,
            'category'      => $this->categorySearch,
            'productName'   => $this->productSearch
        ];
        $this->categories = Category::whereHas('outlet', function (Builder $query) {
            $query->where('slug', $this->outletSearch);
        })->get();
        $this->transactions = SalesHistory::with([
            'product:product_id,product_name',
            'product.categories:category_id,category_name',
            'user:user_id,name',
            'outlet:outlet_id,outlet_name',
            'pesanan:pesanan_id'
        ])->filter($data)->get();
        return view('livewire.laporan-transaksi-index');
    }

    public function printPdf($type)
    {
        $this->printData($type);
        return redirect()->route('download-pdf');
    }
    public function printExcel($type)
    {
        $this->printData($type);
        return Excel::download(new LaporanTransaksi, 'laporan.xlsx');
    }
    public function printData($type)
    {
        $data = [
            'outlet'        => $this->outletSearch,
            'fromDate'      => $this->fromDate,
            'toDate'        => $this->toDate,
            'category'      => $this->categorySearch,
            'productName'   => $this->productSearch
        ];
        $history = SalesHistory::with('taxs')
            ->select(
                'sales_history_id',
                'created_at',
                DB::raw(
                    'SUM(total_price) AS total_penjualan'
                )
            )
            ->filter($data)
            ->groupBy(DB::raw('DAY(created_at)'))
            ->get();
        $data = [
            'transactions'  =>  $history,
            'outlet'        => Outlet::where('slug', $this->outletSearch)->first(),
            'fromDate'      => $this->fromDate,
            'toDate'        => $this->toDate,
            'type'          => $type
        ];
        session(['pdf_data' => $data]);
    }
}
