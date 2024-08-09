<?php

namespace App\Http\Controllers;

use App\Models\Opsi;
use App\Models\User;
use App\Trait\GetOutletByUser;
use Auth;
use Illuminate\Http\Request;

class OpsiController extends Controller
{
    use GetOutletByUser;
    public function getOpsi()
    {
        if ($this->getRole() == 'ADMIN') {
            $outlet = Auth::getUser()->outletWorks()->with('opsi')->get();
        } else {
            $outlet = Auth::getUser()->supervisorHasOutlets()->with('opsi')->get();
        }
        $opsi = $outlet->flatMap->opsi;
        return response()->json([
            'status' => 200,
            'data' => $opsi
        ]);
    }
    public function getDetailOpsi(Opsi $opsi)
    {
        $opsi->load('detailOpsi');
        return response()->json([
            'status' => 200,
            'data' => $opsi
        ]);
    }
    public function store(Request $request) {}
}
