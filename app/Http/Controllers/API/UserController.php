<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::where('active', '=', 1)->all();
        if($user){
                return response()->json([
                    'status' => 1,
                    'message' => 'Success',
                    'user' => $user,
                    
                ],200);
        }

        return response()->json([
            'status' => 1,
            'message' => 'User Not Found',
            'user' => Null,
            
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request){
        
        $this->validate($request, [
                        'username' => 'required',
                        'password' => 'required'
        ]);
        $user = User::where('email', '=', $request->input('username'))
                    ->orWhere('mobile', '=', $request->input('username'))
                    ->first();
        if (!$user) {
            return response()->json([
                'status' => 0,
                'message' => 'Invalid Username'
            ],401);
        }
        // if user exist check for password
        if (!Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'status' => 0,
                'message' => 'Password doesn\'t match'
            ],401);
        }
        // $token = $user->createToken('access_token')->accessToken;
      
        return response()->json([
            'status' => 1,
            'message' => 'Authentication successful',
            // 'token' => $token,
            'user' => $user,
            
        ],200);
    }
}
