<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AlatSewa;

class AlatSewaController extends Controller
{
    public function showAlat($idLapangan)
    {
        $data = AlatSewa::where('idLapangan',$idLapangan)->get();
        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
    }

    public function addAlat(Request $request)
    {
        $data = new AlatSewa;

        $data->idLapangan = $request->idLapangan;
        $data->idOwner = $request->idOwner;
        $data->namaAlat = $request->namaAlat;
        $data->jumlah = $request->jumlah;
        $data->harga = $request->harga;
        $data->save();

        return response()->json([
            'status' => 'Alat berhasil ditambahkan',
            'data' => $data,
        ],200);
    }

    public function updateAlat(Request $request)
    {
        $data = AlatSewa::where('id',$request->id)->where('idOwner',$request->idOwner)->first();
        $data->namaAlat = $request->namaAlat;
        $data->jumlah = $request->jumlah;
        $data->harga = $request->harga;
        $data->save();

        return response()->json([
            'status' => 'Alat berhasil diUpdate',
            'data' => $data,
        ],200);
    }

    public function deleteAlat($id)
    {
        $data = AlatSewa::where('id',$id)->first();

        $data->delete();

        return response()->json([
            'status' => 'Alat berhasil dihapus',
        ],201);
    }
}
