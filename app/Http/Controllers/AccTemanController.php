<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccTeman;

class AccTemanController extends Controller
{
    public function addAccTeman(Request $request)
    {
        $data = new AccTeman;

        $data->idCariTeman = $request->idCariTeman;
        $data->idOwner = $request->idOwner;
        $data->idTeman = $request->idTeman;
        $data->status = $request->status;
        $data->save();

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
    }

    public function showAccTeman($idCariTeman,$idTeman)
    {
        $data = AccTeman::where('idCariTeman',$idCariTeman)->where('idTeman',$idTeman)->get();
        foreach($data as $item){
            $owner = $item->owner;
        }

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
    }

    public function showAccTemanById($id)
    {
        $data = AccTeman::where('id',$id)->first();

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
    }

    public function showOwnerTeman($idCariTeman,$idOwner)
    {
        $data = AccTeman::where('idCariTeman',$idCariTeman)->where('idOwner',$idOwner)->get();
        foreach($data as $item){
            $teman = $item->teman;
        }

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
    }

    public function editAccTeman(Request $request){
        $data = AccTeman::where('id',$request->id)->where('idTeman', $request->idTeman)->first();

        $data->status = $request->status;
        $data->save();

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
    }

    public function deleteAccTeman($id,$idOwner)
    {
        $data = AccTeman::where('id',$request->id)->where('idOwner', $request->idOwner)->first();
        $data->delete();

        return response()->json([
            'status' => 'lapangan berhasil dihapus',
        ],201);
    }
    
}
