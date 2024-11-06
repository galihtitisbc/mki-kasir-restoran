<?php

namespace App\Http\Controllers\API;

use App\Events\CreateOrderEvent;
use App\Events\OrderCreated;
use Validator;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use App\Models\Meja;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\Pesanan;
use DB;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // $outlet = Outlet::where('slug', $slug)->firstOrFail();
            $validator = Validator::make($request->all(), [
                'notification_token'    => 'required',
                'meja_id'               => 'required|numeric|exists:mejas,meja_id',
                'outlet_id'             => 'required|numeric|exists:outlets,outlet_id',
                "nama_pemesan"          => 'required|max:60',
                'status'                => 'required',
                'product.*.product_id'  => 'required|numeric|exists:products,product_id',
                'product.*.qty'         => 'required|integer|min:1'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Gagal',
                    'error' => $validator->errors(),
                ], 401);
            }
            $validated = $validator->validated();
            DB::transaction(function () use ($validated) {
                $meja = Meja::where('meja_id', $validated['meja_id'])->firstOrFail();
                if ($meja->status_meja == 'TERPESAN') {
                    throw new \Exception("Meja Sudah Terpesan", 1);
                }
                $pesanan = Pesanan::create([
                    'meja_id'       =>  $validated['meja_id'],
                    'nama_pemesan'  =>  $validated['nama_pemesan'],
                    'outlet_id'     =>  $validated['outlet_id'],
                    'status'        =>  $validated['status'],
                ]);

                // $this->sendFirebaseNotification($validated['notification_token'], 'Pesanan berhasil', 'Pesanan Anda telah ditambahkan.');
                // event(new OrderCreated($pesanan, $validated['notification_token']));
                // broadcast(new CreateOrderEvent($pesanan))->toOthers();

                $dataProduct = [];
                foreach ($validated['product'] as $value) {
                    $product = Product::where('product_id', $value['product_id'])->first();
                    $dataProduct[] = [
                        'product_id'    =>  $value['product_id'],
                        'qty'           =>  $value['qty'],
                        'harga'         =>  $product->price,
                        'total'         =>  $product->price * $value['qty']
                    ];
                }
                $pesanan->product()->attach($dataProduct);
                $meja->update([
                    'status_meja' => 'TERPESAN',
                ]);
                event(new CreateOrderEvent($pesanan));
            });
            return response()->json([
                'status'    => 'Berhasil',
                'message'   => 'Berhasil Tambah Pesanan Pada Meja Nomor ' . $validated['meja_id'],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal',
                'error' => $e->getMessage(),
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $outlet = Outlet::where('slug', $slug)->firstOrFail();
        $pesanans = $outlet->pesanan()->with(['product'])->orderBy('created_at', 'desc')->get();

        return response()->json([
            'status'    => 'Berhasil',
            'data'   => $pesanans
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function sendFirebaseNotification($fcmToken, $title, $body) {
        $messaging = app('firebase.messaging');
        $message = CloudMessage::withTarget('token', $fcmToken)
        ->withNotification(Notification::create($title, $body));
        $messaging->send($message);
    }
}
