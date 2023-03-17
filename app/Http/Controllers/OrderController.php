<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Hash;

class OrderController extends Controller
{
    public function showOrder($idOwner)
    {
        $data = Order::where('idOwner',$idOwner)->get();
        foreach($data as $item){
            $lapangan = $item->lapangan;
        }

        return response()->json([
            'status' => 'berhasil',
            'data' =>$data,
        ]);
    }

    public function showOrderById($idOwner,$id)
    {
        $data = Order::where('idOwner',$idOwner)->where('id',$id)->get();
        foreach($data as $item){
            $lapangan = $item->lapangan;
        }

        return response()->json([
            'status' => 'berhasil',
            'data' =>$data,
        ]);
    }

    public function checkOut(Request $request)
    {
        $order = new Order;
        $order->generateOrderId();
        $order->idLapangan = $request->idLapangan;
        $order->idOwner = $request->idOwner;
        $order->idAlat = $request->idAlat;
        $order->setTanggalMain($request->tanggalBooking);
        $order->harga = $request->harga;
        $order->jmlJam = $request->jmlJam;
        $order->jamSelesai = $request->jamSelesai;
        $order->jamMulai = $request->jamMulai;
        $order->status = 0;
        $order->save();

        $data = Order::where('id',$order->id)->first();
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');

        $params = array(
            'transaction_details' => array(
                'order_id' => $data->order_id,
                'gross_amount' => $data->harga,
            ),
            'payment_type' => 'credit_card',
            'credit_card'  => array(
                'token_id'      => $_POST['token_id'],
                'authentication'=> true,
            ),
            'customer_details' => array(
                'email' => $data->user->email,
                'phone' => $data->user->nomor,
            ),
        );
        
        $response = \Midtrans\CoreApi::charge($params);

        return response()->json([
            'data' =>$response,
        ]);
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512",$request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture'){
                $order = Order::where('order_id',$request->order_id);
                $order->update(['status' => 1]);
                return response()->json([
                    'data' => 'Berhasil',
                ],200);
            }else if($request->transaction_status == 'deny'){
                $order = Order::where('order_id',$request->order_id);
                $order->update(['status' => 2]);
                return response()->json([
                    'data' => 'pembayaran di tolak',
                ],200);
            }
           
        }
        return response()->json([
            'data' => 'gagal mendapat hash',
        ],200);
    }
}
