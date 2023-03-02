<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kota;

class KotaController extends Controller
{
    public function showKota()
    {
        $data = Kota::get();

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
    }

    public function addKota(Request $request)
    {
        $data = new Kota;

        $data->namaKota = $request->namaKota;
        $data->save();

        return response()->json([
            'status' => 'kota berhasil ditambahkan',
            'data' => $data,
        ],200);
    }

    public function deleteKota($id)
    {
        $data = Kota::where('id',$id)->first();
    
        $data->delete();

        return response()->json([
            'status' => 'kota berhasil dihapus',
        ],201);
    }
}
