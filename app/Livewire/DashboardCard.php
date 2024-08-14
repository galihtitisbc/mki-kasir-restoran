<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SalesHistory;
use App\Trait\GetOutletByUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class DashboardCard extends Component
{
    use GetOutletByUser;
    public $outlets;
    public $outletSearch;
    public $transaksiHariIni;
    public $pajakBulanIni;
    public $jumlahPegawai;
    public function mount()
    {
        $this->transaksiHariIni = 0;
        $this->pajakBulanIni = 0;
        $this->jumlahPegawai = 0;
        $this->outlets = $this->getOutletByUser();
    }
    public function render()
    {
        $this->transaksiHariIni = SalesHistory::whereHas('outlet', function (Builder $query) {
            $query->where('slug', $this->outletSearch);
        })->count();
        $this->pajakBulanIni = SalesHistory::whereHas('outlet', function (Builder $query) {
            $query->where('slug', $this->outletSearch);
        })->whereDate('created_at', Carbon::now()->format('Y-m-01'))->count();
        return view('livewire.dashboard-card');
    }
}
