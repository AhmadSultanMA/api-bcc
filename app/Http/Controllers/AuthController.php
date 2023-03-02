<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;

class AuthController extends Controller
{
    public function showUser()
    {
        $data = User::get();

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
    }

    public function searchUser($name)
    {
        $data = User::where('name','like','%'.$name.'%')->get();

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
    }

    public function findPartner($idKota,$idKategori)
    {
        $data = User::where('idKota',$idKota)->where('idKategori',$idKategori)->get();

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
    }

    public function editIdUser(Request $request)
    {
        $data = User::where('id',$request->id)->first();

        $data->idKota = $request->idKota;
        $data->idKategori = $request->idKategori;
        $data->statusPartner = $request->statusPartner;
        $data->save();

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ],200);

    }

    public function register(Request $request)
    {
        $rules = array(
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            // 'gambar' => 'required|string|max:255',
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return response()->json([
                'message' => $errorString,
            ],401);
        }else{
            $user = User::create([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'gambar' => 'https://res.cloudinary.com/dfkoknpii/image/upload/v1646532385/lastproject/account_jzb2mv.png',
                'nomor' => $request->nomor,
                'statusPartner' => 0,
            ]);

        if ($user) {
            $user->assignRole('user');
            $role = "user";
        }else {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Gagal',
            ],422);
        }

        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json([
            'status' => 'Success',
            'message' => 'Berhasil membuat akun',
            'role' => $role,
            'user' => $user,
            'token' => $token,
        ],201);
        } 
    }

    public function registerPenjual(Request $request)
    {
        $rules = array(
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            // 'gambar' => 'required|string|max:255',
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return response()->json([
                'message' => $errorString,
            ],401);
        }else{
            $penjual = User::create([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'gambar' => 'https://res.cloudinary.com/dfkoknpii/image/upload/v1646532385/lastproject/account_jzb2mv.png',
                'nomor' => $request->nomor,
                'statusPartner' => 0,
            ]);

        if ($penjual) {
            $penjual->assignRole('penjual');
            $role = "penjual";
        }else {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Gagal',
            ],422);
        }

        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json([
            'status' => 'Success',
            'message' => 'Berhasil membuat akun',
            'role' => $role,
            'user' => $user,
            'token' => $token,
        ],201);
        }
        
    }

    public function registerAdmin(Request $request)
    {
        $rules = array(
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            // 'gambar' => 'required|string|max:255',
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return response()->json([
                'message' => $errorString,
            ],401);
        }else{
            $user = User::create([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'gambar' => 'https://res.cloudinary.com/dfkoknpii/image/upload/v1646532385/lastproject/account_jzb2mv.png',
                'nomor' => $request->nomor,
                'statusPartner' => 0,
            ]);

        if ($user) {
            $user->assignRole('admin');
            $role = "admin";
        }else {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Gagal',
            ],422);
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'Berhasil membuat akun',
            'role' => $role,
            'user' => $user,
        ],200);
        } 
    }

    public function login(Request $request)
    {
        $rules = array(
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return response()->json([
                'message' => $errorString,
            ],401);
        }else{
            $user = User::where('email',$request->email)->first();

            if(!$user || !Hash::check($request->password, $user->password)){
                return response()->json([
                    'message' => 'Unauthorized',
                ],401);
            }

            $token = $user->createToken('token-name')->plainTextToken;
            $roles = $user->getRoleNames();

            return response()->json([
                'status' => 'Success',
                'message' => 'Berhasil login',
                'user' => $user,
                'role' => $roles,
                'token' => $token,
            ],200);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'berhasil logout',
        ]);
    }
}


    