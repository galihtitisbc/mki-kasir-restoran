<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Outlet;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class SeluruhOutlet extends Component
{
    public $outlets;
    public $outletSearch;
    public function mount()
    {
        $this->outlets =
            Outlet::withCount(['salesHistories' => function ($query) {
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            }]);
    }
    public function render()
    {
        $this->outlets
            = $this->outlets->when($this->outletSearch ?? null, function (Builder $query) {
                return $query->where('outlet_name', 'LIKE', '%' . $this->outletSearch . '%');
            })->get();
        return view('livewire.seluruh-outlet');
    }
}
