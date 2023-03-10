<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CariTeman;

class CariTemanController extends Controller
{
    public function showCariTeman($idKategori,$idKota)
    {
        $data = CariTeman::where('idKategori',$idKategori)->where('idKota',$idKota);
        foreach($data as $item){
            $owner = $item->user;
        } 

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
    }

    public function addCariTeman(Request $request)  
    {
        $data = new CariTeman;

        $data->idOwner = $request->idOwner;
        $data->idKategori = $request->idKategori;
        $data->idKota = $request->idKota;
        $data->setTanggalMain($request->tanggalMain);
        $data->jam = $request->jam;
        $data->deskripsi = $request->deskripsi;
        $data->save();

        return response()->json([
            'status' => 'Cari Teman berhasil ditambahkan',
            'data' => $data,
        ],200);
    }

    public function updateCariTeman(Request $request)
    {
        $data = CariTeman::where('id',$request->id)->where('idOwner',$request->idOwner)->first();
        $data->setTanggalMain($request->tanggalMain);
        $data->getTanggalMain();
        $data->jam = $request->jam;
        $data->deskripsi = $request->deskripsi;
        $data->save();

        return response()->json([
            'status' => 'Tanggal Main berhasil diUpdate',
            'data' => $data,
        ],200);
    }

    public function deleteCariTeman($id)
    {
        $data = CariTeman::where('id',$id)->first();

        $data->delete();

        return response()->json([
            'status' => 'Cari Teman berhasil dihapus',
        ],201);
    }
}
