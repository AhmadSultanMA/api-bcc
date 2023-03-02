<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function showKategori()
    {
        $data = Kategori::get();

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
    }

    public function addKategori(Request $request)
    {
        $data = new Kategori;

        $data->namaKategori = $request->namaKategori;
        $data->save();

        return response()->json([
            'status' => 'Kategori berhasil ditambahkan',
            'data' => $data,
        ],200);
    }

    public function deleteKategori($id)
    {
        $data = Kategori::where('id',$id)->first();
    
        $data->delete();

        return response()->json([
            'status' => 'Kategori berhasil dihapus',
        ],201);
    }
}
