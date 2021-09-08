<?php

namespace App\Http\Controllers;

use App\Models\Coba;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CobaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function login(Request $request){
        $user = User::where('email',$request->email)->first();
 
        if(!$user or !\Hash::check($request->password,$user->password)){
            return response()->json([
                'message' => 'Login Failed'
            ],401);
        }else{
            $token = $user->createToken('token-name')->plainTextToken;
            return response()->json([
                'message' => 'success',
                'user' => $user,
                'token' =>$token
            ],200);
        }
     }
     public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Berhasil logout ',
        ],200);
     }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $data = $request->all();

        $validator = Validator::make($data, [
            'nama' => 'required|max:255',
            'umur' => 'required|max:255',
            'alamat' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $user = new Coba;
        $user->nama = $request->nama;
        $user->umur = $request->umur;
        $user->alamat = $request->alamat;

        $user->save();
        return response()->json([
            'status' => 'OK',
            'message' =>'berhasil disimpan',
            'data' => $user
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coba  $coba
     * @return \Illuminate\Http\Response
     */
    public function show(Coba $coba)
    {
       return response()->json($coba->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coba  $coba
     * @return \Illuminate\Http\Response
     */
    public function edit($coba)
    {
        $user = Coba::firstWhere('id', $coba);
        if($user)
        {
            return response()->json([
                'message' => 'success',
                'data'    => $user
                
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'id not found',
   
                
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coba  $coba
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$coba)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'umur' => 'required|max:255',
            'alamat' => 'required'
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find post by ID
        $user = Coba::firstWhere('id', $coba);

        if($user) {

            //update post
            $user->update([
                'nama'     => $request->nama,
                'umur'   => $request->umur,
                'alamat' => $request->alamat
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Update Berhasil',
                'data'    => $user
                  
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => $user,
        ], 404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coba  $coba
     * @return \Illuminate\Http\Response
     */
    public function destroy($coba)
    { 
      $check =  Coba::firstWhere('id', $coba);

      if($check)
      {
          Coba::destroy($coba);
          return response([
              'status' => 'OK',
              'message' => 'Data di hapus'
          ],200);

      }else{
        return response([
            'status' => 404,
            'message' => 'Id tidak di temukan'
        ],404);
      }
    }
}
