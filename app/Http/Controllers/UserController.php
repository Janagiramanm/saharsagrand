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
// namespace Illuminate\Auth\Middleware;

use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where('type', '!=', 'superadmin')
        ->paginate('10');
        return view('users.index',compact(['users']));
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
       
        $fourRandomDigit = mt_rand(100000,999999);
    
        AppHelper::sendRegistrationOtp($_POST['name'], $_POST['mobile'], $fourRandomDigit);
        $user = new User();
        $user->name = $_POST['name'];
        $user->email= $_POST['email'];
        $user->mobile = $_POST['mobile'];
        $user->block = $_POST['block'];
        $user->flat_number = $_POST['flat_number'];
        $user->type = $_POST['type'];
        $user->otp = $fourRandomDigit;
        $user->role = $_POST['type'];
        $user->save();
       
        if($user){
            return response()->json($user);
           
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

     /**
     * to check otp 
     */
    public function checkOTP(Request $request){
        if($_POST['otp']!=''){
            $isOtpExist = User::where('otp',$_POST['otp'])
            ->where('id', $_POST['user_id'])->first();
           
            if($isOtpExist->otp == $_POST['otp']){
                echo 'true';
            }else{
                echo 'false';
            }
        }
    }

    /**
     * to verify mobile
     */
    public function mobileVerify(Request $request){
        
        if($_POST['otp']!=''){
            $user = User::where('id',$_POST['user_id'])->first();
            if($user->otp == $_POST['otp']){
                $user->mobile_verified_at = date('Y-m-d H:i:s');
                if($user->save()){
                    echo 'true';
                }
            }else{
                echo 'false';
            }
           
           
        }
    }

    /**
     * to login
     */
    public function login(Request $request){

        $request->email = $_POST['username'];
        $request->password = $_POST['password'];
       
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            $msg =  array(
                'status'=>1,
                'message'=>'Success'
            );
            return response()->json($msg);
        }else{
            $msg =  array(
                'status'=>0,
                'message'=>'Failed'
            );
            return response()->json($msg);
        }
    }

    /**
     * to activate
     */
    public function activate(Request $request){
        $update = User::where('id',$_POST['userid'])->update(array('active' => 1));
        if($update){
            $msg =  array(
                'status'=>1,
                'message'=>'Success'
            );
            return response()->json($msg);
        }
    }
}
