<?php

namespace App\Livewire;

use App\Models\HistoryBayarPajak as ModelsHistoryBayarPajak;
use Livewire\Component;
use App\Models\SalesHistory;
use App\Trait\GetOutletByUser;
use DB;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;

class HistoryBayarPajak extends Component
{
    use GetOutletByUser;
    public $outlets = '';
    public $outletSearch;
    public $riwayatPajak;
    public function mount()
    {
        $this->outlets = $this->getOutletByUser();
    }
    public function render()
    {
        $this->riwayatPajak = ModelsHistoryBayarPajak::with('pajakYangDibayar')
            ->whereHas('outlet', function (Builder $query) {
                $query->where('slug', $this->outletSearch);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        return view('livewire.history-bayar-pajak');
    }
}
