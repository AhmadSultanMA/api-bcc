<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderKursus;
use GuzzleHttp\Client;
use Response;
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

    public function showOrderKursus($idOwner)
    {
        $data = OrderKursus::where('idOwner',$idOwner)->get();
        foreach($data as $item){
            $kursus = $item->kursus;  
        }

        return response()->json([
            'status' => 'berhasil',
            'data' =>$data,
        ]);
    }

    public function showOrderIdLapangan($idLapangan)
    {
        $data = Order::where('idLapangan',$idLapangan)->get();
        foreach($data as $item){
            $lapangan = $item->lapangan;  
        }

        return response()->json([
            'status' => 'berhasil',
            'data' =>$data,
        ]);
    }

    public function showOrderIdKursus($idKursus)
    {
        $data = OrderKursus::where('idKursus',$idKursus)->get();
        foreach($data as $item){
            $kursus = $item->kursus;  
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

    public function showOrderKursusById($idOwner,$id)
    {
        $data = OrderKursus::where('idOwner',$idOwner)->where('id',$id)->get();
        foreach($data as $item){
            $kursus = $item->kursus;  
        }

        return response()->json([
            'status' => 'berhasil',
            'data' =>$data,
        ]);
    }

    public function getToken(Request $request)
    {
        $client = new Client();
        $client_key = $request->client_key;
        $card_number = $request->card_number;
        $card_cvv = $request->card_cvv;
        $card_exp_month = $request->card_exp_month;
        $card_exp_year = $request->card_exp_year; 
        $response = $client->request('GET',"https://api.sandbox.midtrans.com/v2/token?client_key=$client_key&card_number=$card_number&card_cvv=$card_cvv&card_exp_month=$card_exp_month&card_exp_year=$card_exp_year", [
            'headers' => [
                'Accept' => 'application/json',
              ],
        ]);
        $result = $response->getBody();
        echo $result;
        
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
                'first_name' => $data->user->name,
                'email' => $data->user->email,
                'phone' => $data->user->nomor,
            ),
        );
        
        $response = \Midtrans\CoreApi::charge($params);

        return response()->json([
            'data' =>$response,
            'name' =>$data->user->name
        ]);
    }

    public function checkOutKursus(Request $request)
    {
        $order = new OrderKursus;
        $order->generateOrderId();
        $order->idOwner = $request->idOwner;
        $order->idKursus = $request->idKursus;
        $order->setTanggalKursus($request->tanggalBooking);
        $order->harga = $request->harga;
        $order->jmlBulan = $request->jmlBulan;
        $order->status = 0;
        $order->save();

        $data = OrderKursus::where('id',$order->id)->first();
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
                'first_name' => $data->user->name,
                'email' => $data->user->email,
                'phone' => $data->user->nomor,
            ),
        );
        
        $response = \Midtrans\CoreApi::charge($params);

        return response()->json([
            'data' =>$response,
            'name' =>$data->user->name
        ]);
    }

    public function callback(Request $request)
    {
        $order = Order::where('order_id',$request->order_id);
        $orderKursus = OrderKursus::where('order_id',$request->order_id);
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512",$request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture'){
                $orderKursus->update(['status' => 1]);
                $order->update(['status' => 1]);
                return response()->json([
                    'data' => 'Berhasil',
                ],200);
            }else if($request->transaction_status == 'deny'){
                $orderKursus->update(['status' => 2]);
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