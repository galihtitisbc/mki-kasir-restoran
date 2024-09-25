<?php

namespace App\Http\Controllers;

use App\Models\SatuanBahan;
use App\Trait\GetOutletByUser;
use Illuminate\Http\Request;

class SatuanBahanController extends Controller
{
    use GetOutletByUser;
    public function getSatuanBahan(Request $request)
    {
        $outletIds = $this->getOutletByUser()->pluck('outlet_id')->toArray();
        $data = SatuanBahan::whereIn('outlet_id', $outletIds)
            ->distinct()
            ->pluck('satuan');
        return response()->json([
            'data'  =>  $data
        ]);
    }
    public function storeSatuan(Request $request)
    {
        $validated = $request->validate([
            'satuan'    =>  'required'
        ]);
        $outletIds = $this->getOutletByUser()->pluck('outlet_id');
        $data = [];
        foreach ($outletIds as $item) {
            $data[] = [
                'outlet_id'     =>  $item,
                'satuan'        =>  $validated['satuan']
            ];
        }
        SatuanBahan::insert($data);
        return response()->json([
            'message'   =>  'Sukses',
            'data'      =>  'Sukses Tambah Bahan',
        ]);
    }
}
