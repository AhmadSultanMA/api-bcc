<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

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

    public function checkOut(Request $request)
    {
        $order = new Order;
        $order->idLapangan = $request->idLapangan;
        $order->idOwner = $request->idOwner;
        $order->idAlat = $request->idAlat;
        $order->setTanggalMain($request->tanggalBooking);
        $order->harga = $request->harga;
        $order->jmlJam = $request->jmlJam;
        $order->jamSelesai = $request->jamSelesai;
        $order->jamMulai = $request->jamMulai;
        $order->save();
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->harga,
            ),
            'payment_type' => 'credit_card',
            'credit_card'  => array(
                'token_id'      => $_POST['token_id'],
                'authentication'=> true,
            ),
            'customer_details' => array(
                'email' => $order->user->email,
                'name' => $order->user->name,
                'phone' => $order->user->nomor,
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
        $hashed = hash($request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'settlement'){
                $order == Order::where('id',$request->order_id);
                $order->status = 'Paid';
                $order->save();

                return response()->json([
                    'data' => $order,
                ]);
            }
        }
    }
}
