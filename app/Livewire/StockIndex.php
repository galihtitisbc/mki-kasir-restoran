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
    public $outlet;
    public function mount()
    {
        $this->outlets = $this->getOutletByUser();
    }
    public function render()
    {

        $this->stock = Stock::with('bahan')->stockByOutlet($this->outlet)->get();
        return view('livewire.stock-index');
    }
}
