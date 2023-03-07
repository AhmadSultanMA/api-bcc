<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lapangan;

class LapanganController extends Controller
{
    public function showLapangan($idKategori,$idKota)
    {
        $data = Lapangan::where('idKategori',$idKategori)->where('idKota',$idKota)->get();
        foreach($data as $item){
            $owner = $item->user;
        } 

        return response()->json([
            'status' => 'berhasil',
            'data' =>$data,
        ]);
    }

    public function showOwnedLapangan($idOwner)
    {
        $data = Lapangan::where('idOwner',$idOwner)->get();

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
    }

    public function showLapanganById($id)
    {
        $data = Lapangan::where('id',$id)->first();
        $owner = $data->user;
        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ],200);
    }

    public function searchLapangan($name)
    {
        $data = Lapangan::where('namaLapangan','like','%'.$name.'%')->get();
        foreach($data as $item){
            $owner = $item->user;
        } 

        return response()->json([
            'status' => 'berhasil',
            'data' =>$data,
        ]);
    }

    public function addLapangan(Request $request)
    {
        $data = new Lapangan;
        
            $image  = $request->file('gambar');
            $result = CloudinaryStorage::upload($image->getRealPath(), $image->getClientOriginalName());

            $data->idKategori = $request->idKategori;
            $data->idKota = $request->idKota;
            $data->idOwner = $request->idOwner;
            $data->namaLapangan = $request->namaLapangan;
            $data->lokasi = $request->lokasi;
            $data->deskripsi = $request->deskripsi;
            $data->harga = $request->harga;
            $data->gambar = $result;
            $data->jamBuka = $request->jamBuka;
            $data->jamTutup = $request->jamTutup;
            $data->statusToko = $request->statusToko;
            $data->nomor = $request->nomor;
            $berhasil = $data->save();
            if($berhasil){
                return response()->json([
                    'status' => 'berhasil',
                    'data' => $data,
                    'owner' => $data->user,
                ],200);
            }else{
                return response()->json([
                    'status' => 'gagal',
                ]);
            }
    }

    public function updateLapangan(Request $request)
    {
        $data = Lapangan::where('id',$request->id)->where('idOwner',$request->idOwner)->first();
        if ($request->file('gambar') === null){
            $data->namaLapangan = $request->namaLapangan;
            $data->lokasi = $request->lokasi;
            $data->deskripsi = $request->deskripsi;
            $data->harga = $request->harga;
            $data->jamBuka = $request->jamBuka;
            $data->jamTutup = $request->jamTutup;
            $data->statusToko = $request->statusToko;
            $data->nomor = $request->nomor;
            $data->save();
            return response()->json([
                'status' => 'berhasil',
                'data' => $data,
            ],200);
         }else{
            $file  = $request->file('gambar');
            $image = $data->gambar;
            $result = CloudinaryStorage::replace($image, $file->getRealPath(), $file->getClientOriginalName());

            $data->namaLapangan = $request->namaLapangan;
            $data->lokasi = $request->lokasi;
            $data->deskripsi = $request->deskripsi;
            $data->harga = $request->harga;
            $data->gambar = $result;
            $data->jamBuka = $request->jamBuka;
            $data->jamTutup = $request->jamTutup;
            $data->statusToko = $request->statusToko;
            $data->nomor = $request->nomor;
            $data->save();
            return response()->json([
                'status' => 'berhasil',
                'data' => $data,
            ],200);
         }
    }

    public function deleteLapangan($id)
    {
        $data = Lapangan::where($id,'id')->first();

        $data->delete();

        return response()->json([
            'status' => 'lapangan berhasil dihapus',
        ],201);
    }
}
