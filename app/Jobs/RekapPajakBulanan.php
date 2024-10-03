<?php

namespace App\Jobs;

use App\Models\HistoryBayarPajak;
use Auth;
use Carbon\Carbon;
use App\Models\Outlet;
use App\Models\SalesHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RekapPajakBulanan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $tanggal = Carbon::now();
        $outlet = Outlet::select('outlet_id')->get();
        $outletId = $outlet->pluck('outlet_id')->toArray();
        $pajak = SalesHistory::with('taxs')
            ->whereHas('outlet', function (Builder $query) use ($outletId) {
                $query->whereIn('outlet_id', $outletId);
            })
            ->whereMonth('created_at', $tanggal->month)
            ->whereYear('created_at', $tanggal->year)
            ->get();
        $data = [];
        foreach ($pajak as $value) {
            $data[] = [
                'outlet_id' =>  $value->outlet_id,
                'untuk_bulan' => $tanggal->format('F'),
                'jumlah_bayar' => $value->taxs->sum('pivot.total'),
                'created_at'    => $tanggal,
                'updated_at'    => $tanggal,
            ];
        }
        $groupedData = [];
        foreach ($data as $item) {
            $outletId = $item['outlet_id'];
            if (!isset($groupedData[$outletId])) {
                $groupedData[$outletId] = [
                    'outlet_id' => $outletId,
                    'untuk_bulan' => $item['untuk_bulan'],
                    'jumlah_bayar' => 0,
                    'created_at' => $item['created_at'],
                    'updated_at' => $item['updated_at'],
                ];
            }
            $groupedData[$outletId]['jumlah_bayar'] += $item['jumlah_bayar'];
        }
        HistoryBayarPajak::insert($groupedData);
    }
}
