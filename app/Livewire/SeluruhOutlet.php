<?php

namespace App\Livewire;

use App\Models\Outlet;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class SeluruhOutlet extends Component
{
    public $outlets;
    public $outletSearch;
    public function mount()
    {
        $this->outlets = Outlet::all();
    }
    public function render()
    {
        $this->outlets = Outlet::when($this->outletSearch ?? null, function (Builder $query) {
            return $query->where('outlet_name', 'LIKE', '%' . $this->outletSearch . '%');
        })->get();
        return view('livewire.seluruh-outlet');
    }
}
