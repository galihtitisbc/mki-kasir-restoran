<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Product;
use Livewire\Component;
use App\Trait\FormatRupiah;
use App\Models\SalesHistory;
use App\Trait\GetOutletByUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class DashboardCard extends Component
{
    use GetOutletByUser, FormatRupiah;
    public $outlets;
    public $outletSearch;
    public $transaksiHariIni;
    public $pajakBulanIni;
    public $jumlahPegawai;
    public $jumlahProduk;
    public $pajakSeluruhOutlet;
    public function mount()
    {
        $this->transaksiHariIni = 0;
        $this->pajakBulanIni = 0;
        $this->jumlahPegawai = 0;
        $this->jumlahProduk = 0;
        $this->outlets = $this->getOutletByUser();

        $this->pajakSeluruhOutlet =
            SalesHistory::with('taxs')
            ->whereHas('outlet', function (Builder $query) {
                $userFilter = [
                    'role'      => Auth::user()->roles->pluck('name')[0],
                    'user_id'   => Auth::user()->user_id,
                ];
                $query->whereHas($userFilter['role'] == 'SUPERVISOR' ? 'supervisor' : 'outletHasPegawai', function (Builder $query) use ($userFilter) {
                    $query->where('users.user_id', $userFilter['user_id']);
                });
            })
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->get()
            ->sum(fn($item) => $item->taxs->sum('pivot.total'));
        $this->pajakSeluruhOutlet = $this->rupiah($this->pajakSeluruhOutlet);
    }
    public function render()
    {

        $this->transaksiHariIni = SalesHistory::whereHas('outlet', function (Builder $query) {
            $query->where('slug', $this->outletSearch);
        })->whereDate('created_at', Carbon::today())->count();

        $this->pajakBulanIni = SalesHistory::with('taxs')
            ->whereHas('outlet', function (Builder $query) {
                $query->where('slug', $this->outletSearch);
            })
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->get()
            ->sum(fn($item) => $item->taxs->sum('pivot.total'));

        $this->pajakBulanIni = $this->rupiah($this->pajakBulanIni);

        $this->jumlahPegawai = User::whereHas('outletWorks', function (Builder $query) {
            $query->where('slug', $this->outletSearch);
        })->whereNotNull('supervisor_id')->count();
        $this->jumlahProduk = Product::whereHas('outlets', function (Builder $query) {
            $query->where('slug', $this->outletSearch);
        })->count();
        return view('livewire.dashboard-card');
    }
}
