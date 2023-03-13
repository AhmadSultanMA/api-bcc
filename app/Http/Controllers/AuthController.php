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

    public function showUserById($id)
    {
        $data = User::where('id',$id)->first();
        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ],200);
    }

    public function searchUser($name)
    {
        $data = User::where('name','like','%'.$name.'%')->get();

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ]);
    }

    public function editUser(Request $request)
    {
        $data = User::where('id',$request->id)->first();
        if ($request->file('gambar') === null){
        $data->name = $request->name;
        $data->pekerjaan = $request->pekerjaan;
        $data->umur = $request->umur;
        $data->deskripsi = $request->deskripsi;
        $data->save();

        return response()->json([
            'status' => 'berhasil',
            'data' => $data,
        ],200);
        }else{
            $file  = $request->file('gambar');
            $image = $data->gambar;
            $result = CloudinaryStorage::replace($image, $file->getRealPath(), $file->getClientOriginalName());
            
            $data->name = $request->name;
            $data->pekerjaan = $request->pekerjaan;
            $data->umur = $request->umur;
            $data->deskripsi = $request->deskripsi;
            $data->gambar = $result;
            $data->save();

            return response()->json([
                'status' => 'berhasil',
                'data' => $data,
            ],200);
        }
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
                'jenisKelamin' => $request->jenisKelamin,
                'umur' => $request->umur,
                'pekerjaan' => $request->pekerjaan,
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
            'user' => $user->name,
            'nomor'=>$user->nomor,
            'id'=>$user->id,
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
            $user = User::create([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'gambar' => 'https://res.cloudinary.com/dfkoknpii/image/upload/v1646532385/lastproject/account_jzb2mv.png',
                'nomor' => $request->nomor,
                'jenisKelamin' => $request->jenisKelamin,
                'umur' => $request->umur,
                'pekerjaan' => $request->pekerjaan,
            ]);

        if ($user) {
            $user->assignRole('penjual');
            $role = 'penjual';
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
            'user' => $user->name,
            'nomor'=>$user->nomor,
            'id'=>$user->id,
            'token' => $token,
        ],201);
        }
        
    }

    public function registerPelatih(Request $request)
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
                'jenisKelamin' => $request->jenisKelamin,
                'umur' => $request->umur,
                'pekerjaan' => $request->pekerjaan,
            ]);

        if ($user) {
            $user->assignRole('pelatih');
            $role = 'pelatih';
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
            'user' => $user->name,
            'nomor'=> $user->nomor,
            'id'=> $user->id,
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
        // d

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
                'jenisKelamin' => $request->jenisKelamin,
                'umur' => $request->umur,
                'pekerjaan' => $request->pekerjaan,
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
                'user' => $user->name,
                'nomor'=>$user->nomor,
                'id'=>$user->id,
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


    