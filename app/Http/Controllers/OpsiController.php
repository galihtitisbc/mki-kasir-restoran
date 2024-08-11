<?php

namespace App\Http\Controllers;

use App\Models\DetailOpsi;
use Auth;
use App\Models\Opsi;
use App\Models\User;
use Illuminate\Http\Request;
use App\Trait\GetOutletByUser;
use DB;
use Illuminate\Support\Facades\Validator;

class OpsiController extends Controller
{
    use GetOutletByUser;
    public function index(Request $request)
    {
        $slug = $request->query('outlet');
        $opsi = Opsi::with('detailOpsi')->opsiByOutlet($slug)->get();
        return view('opsi.index', [
            'title'     =>  'Opsi Produk',
            'outlet'    =>  $this->getOutletByUser(),
            'opsi'      =>  $opsi
        ]);
    }
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
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $rules = [
                'opsi.*' => 'required|string',
                'harga.*' => 'required|numeric',
                'grupOpsi.*' => 'nullable|string',
            ];
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages()
                ]);
            }
            $dataInsertOpsi = [];
            DB::transaction(function () use ($data, $dataInsertOpsi) {
                $opsi = Opsi::create([
                    'opsi_name' => $data[count($data) - 1]['grupOpsi'],
                    'outlet_id' => $data[count($data) - 1]['outletId'],
                ]);
                for ($i = 0; $i < count($data) - 1; $i++) {
                    $dataInsertOpsi[] = [
                        'opsi_id'   => $opsi->id,
                        'opsi'      => $data[$i]['opsi'],
                        'harga'     => $data[$i]['harga'],
                    ];
                }
                DetailOpsi::insert($dataInsertOpsi);
            });
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil Tambah Opsi'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 400,
                'errors' => $th->getMessage()
            ]);
        }
    }
    public function update(Request $request, Opsi $opsi)
    {
        try {
            $data = $request->all();
            $rules = [
                'opsi.*' => 'required|string',
                'harga.*' => 'required|numeric',
                'grupOpsi.*' => 'nullable|string',
            ];
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages()
                ]);
            }
            $dataInsertOpsi = [];
            DB::transaction(function () use ($data, $dataInsertOpsi, $opsi) {
                $opsi->update([
                    'opsi_name' => $data[count($data) - 1]['grupOpsi'],
                    'outlet_id' => $data[count($data) - 1]['outletId'],
                ]);
                for ($i = 0; $i < count($data) - 1; $i++) {
                    $dataInsertOpsi[] = [
                        'opsi'      => $data[$i]['opsi'],
                        'harga'     => $data[$i]['harga'],
                    ];
                }
                $opsi->detailOpsi()->update($dataInsertOpsi);
            });
            return response()->json([
                'status' => 200,
                'message' => $opsi
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 400,
                'errors' => $th->getMessage()
            ]);
        }
    }
    public function destroy(Opsi $opsi)
    {
        try {
            $opsi->delete();
            return redirect('/dashboard/opsi-produk')->with('status', 'success');
        } catch (\Throwable $e) {
            return redirect('/dashboard/opsi-produk')->with('status', 'error');
        }
    }
}
