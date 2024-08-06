<?php

namespace App\Livewire;

use App\Models\SalesHistory;
use App\Trait\GetOutletByUser;
use App\Trait\UserAndRoleLoggedIn;
use Auth;
use Livewire\Component;

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
    public function mount()
    {
        if ($this->getRole() == 'ADMIN') {
            $outlet = Auth::getUser()->outletWorks()->with('categories')->get();
        } else {
            $outlet = Auth::getUser()->supervisorHasOutlets()->with('categories')->get();
        }
        $this->categories = $outlet->flatMap(function ($outlet) {
            return $outlet->categories;
        });
        $this->outlets = $this->getOutletByUser();
    }
    public function render()
    {
        $data = [
            'outlet'    => $this->outletSearch,
            'fromDate'  => $this->fromDate,
            'toDate'    => $this->toDate,
            'category' => $this->categorySearch
        ];
        $this->transactions = SalesHistory::with([
            'product:product_id,product_name',
            'product.categories:category_id,category_name',
            'user:user_id,name',
            'outlet:outlet_id,outlet_name',
            'pesanan:pesanan_id'
        ])->filter($data)->get();
        return view('livewire.laporan-transaksi-index');
    }
}
