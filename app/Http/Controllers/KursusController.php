<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KursusPelatih;

class KursusController extends Controller
{
    public function showKursus($idKategori,$idKota)
    {
        $data = KursusPelatih::where('idKategori',$idKategori)->where('idKota',$idKota)->get();
        foreach($data as $item){
            $kota = $item->kota;
            $kategori = $item->kategori;
        } 

        return response()->json([
            'status' => 'berhasil',
            'data' =>$data,
        ]);
    }

    public function showOwnedKursus($idPelatih)
    {
        $data = KursusPelatih::where('idPelatih',$idPelatih)->get();
        foreach($data as $item){
            $kota = $item->kota;
            $kategori = $item->kategori;
        } 

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
    }

   public function addKursus(Request $request)
   {
        $data = new KursusPelatih;
        $data->idKategori = $request->idKategori;
        $data->idKota = $request->idKota;
        $data->idPelatih = $request->idPelatih;
        $data->deskripsi = $request->deskripsi;
        $data->harga = $request->harga;
        $data->target = $request->target;
        $data->save();

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
   }

   public function editKursus(Request $request)
   {
        $data = KursusPelatih::where('id',$request->id)->first();
        $data->deskripsi = $request->deskripsi;
        $data->harga = $request->harga;
        $data->target = $request->target;
        $data->save();

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
   }

   public function deleteKursus($id)
   {
        $data = KursusPelatih::where('id',$id)->first();

        $data->delete();

        return response()->json([
            'status' => 'kursus berhasil dihapus',
        ],201);
   }
}
