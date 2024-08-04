<?php

namespace App\Livewire;

use App\Models\Stock;
use App\Trait\GetOutletByUser;
use Livewire\Component;

class StockIndex extends Component
{
    use GetOutletByUser;
    public $outlets = '';
    public $stock = '';
    public $outletSearch;
    public $fromDate;
    public $toDate;
    public function mount()
    {
        $this->outlets = $this->getOutletByUser();
    }
    public function render()
    {
        $data = [
            'outlet' => $this->outletSearch,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
        ];
        $this->stock = Stock::with('bahan')->stockByOutlet($data)->get();
        return view('livewire.stock-index');
    }
}
