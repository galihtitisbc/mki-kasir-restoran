<?php

namespace App\Http\Controllers\SUPERADMIN;

use Carbon\Carbon;
use App\Models\Outlet;
use App\Models\SalesHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardSuperAdmin extends Controller
{
    public function index()
    {
        return view('superadmin.home', [
            'title' =>  'Dashboard'
        ]);
    }
    public function getOutlet()
    {
        $outlet = Outlet::withCount('salesHistories')
            ->orderBy('sales_histories_count', 'desc')
            ->first();
        $salesPerBulan = SalesHistory::where('outlet_id', $outlet->outlet_id)
            ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(sales_history_id) as total_sales'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $chartData = array_fill(1, 12, 0);
        $salesPerBulan = SalesHistory::where('outlet_id', 2)
            ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(sales_history_id) as total_sales'))
            ->where(DB::raw('YEAR(created_at)'), Carbon::now()->year)
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->get();
        $chartData = array_fill(1, 12, 0);
        foreach ($salesPerBulan as $item) {
            $chartData[$item->month] = $item->total_sales;
        }
        return response()->json([
            'data'  =>  $outlet,
            'sales' =>  $chartData
        ], 200);
    }
}
