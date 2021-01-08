<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Helpers\AppHelper;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('booking.create');
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
        //

        $data = $_POST;
       
       
        $fourRandomDigit = mt_rand(1000,9999);

        
        AppHelper::sendRegistrationOtp($data['name'], $data['mobile'], $fourRandomDigit);
    
       $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'block' => $data['block'],
            'flat_number' => $data['flat_number'],
            'type' => $data['type'],
            'otp'=>$fourRandomDigit,
            'active'=>0
           // 'password' => Hash::make($data['password']),
        ]);
        $userId = $user->id;

        if($user){
           echo $userId;
        }else{
            echo 'failed';
        }
        
        //return view('users.regOtp',compact(['userId']));
        // return redirect(route('/register'))->withSuccess('Your details has been registered successfully. Your login credentials will send via SMS. !');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

    /**
     * to check email duplication
     */
    public function checkEmail(Request $request){
        if($_POST['email']!=''){
            $isEmailExist = User::where('email',$_POST['email'])->first();
            if($isEmailExist){
                echo 'true';
            }else{
                echo 'false';
            }
        }
    }
}
