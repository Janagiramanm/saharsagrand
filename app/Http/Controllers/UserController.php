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
use Illuminate\Support\Str;
use App\Flat;
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
        ->where('mobile_verified_at', '!=', '')
        ->paginate('10');
        // echo '<pre>';
        // print_r($users);
        // exit;
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
       
        $sixRandomDigit = mt_rand(100000,999999);
    
        AppHelper::sendRegistrationOtp($_POST['name'], $_POST['mobile'], $sixRandomDigit);
        $user = new User();
        $user->name = $_POST['name'];
        $user->email= $_POST['email'];
        $user->mobile = $_POST['mobile'];
        $user->block = $_POST['block'];
        $user->flat_number = $_POST['flat_number'];
        $user->type = $_POST['type'];
        $user->otp = $sixRandomDigit;
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
     * to check mobile duplication
     */
 
    public function checkMobile(Request $request){
        if($_POST['mobile'] != ''){
            $isMobileExist = User::where('mobile',$_POST['mobile'])
            ->where('mobile_verified_at','!=', '')->first();
            if($isMobileExist){
                echo 'true';
            }else{
                echo 'false';
            }
        }
    }

    /**
     * to check email duplication
     */
    public function checkEmail(Request $request){
        if($_POST['email']!=''){
            $isEmailExist = User::where('email',$_POST['email'])
            ->where('mobile_verified_at','!=', '')->first();
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

        $request->username = $_POST['username'];
        $request->password = $_POST['password'];
       
        //if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
        if (Auth::attempt([
                    'email' => $request->username,
                    'password' => $request->password
                ],$request->has('remember'))
                || Auth::attempt([
                    'mobile' => $request->username,
                    'password' => $request->password
                ],$request->has('remember'))){
                
            $user = User::where('email', '=', $request->username  )
                       ->orWhere('mobile' , '=', $request->username)->first();
           // echo $user['type'];exit;
            $msg =  array(
                'status'=>1,
                'message'=>'Success',
                'type'=>$user['type']
            );
            return response()->json($msg);
        }else{
            $msg =  array(
                'status'=>0,
                'message'=>'Failed',
                'type'=>Null
            );
            return response()->json($msg);
        }
    }

    /**
     * to activate
     */
    public function activate(Request $request){
       //$rndString = Str::random(8);
        $rndString = mt_rand(100000,999999);
        $hashed_password = Hash::make($rndString);
        $user = User::find($_POST['userid']);
        $user->active = 1;
        $user->password = $hashed_password;
        $user->save();
        //$user = User::where('id',$_POST['userid'])->update(array('active' => 1,'password' => $hashed_password));
       
        AppHelper::sendActivationSms($user['name'],$user['mobile'], $rndString);
     
        if($user){
            $msg =  array(
                'status'=>1,
                'message'=>'Success'
            );
            return response()->json($msg);
        }
    }

    /**
     * to change password
     */
    public function changePassword(Request $request){
        $new_password = $_POST['password'];
        $hashed_password = Hash::make($new_password);
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->password = $hashed_password;
        if($user->save()){
            $msg =  array(
                'status'=>1,
                'message'=>'Success'
            );
            return response()->json($msg);
        }
    }

    /**
     * to get flats
     */
    public function getFlats(Request $request){

         $block_id = $_POST['block_id'];
         $flats =Flat::select('id','flat_number')->where('block_id',$block_id)->groupBy('flat_number','id')->get();
         if($flats){
             //$select = '<select name="flat_number"  >';
             $options = '<option>Select a Flat</option>';
             foreach($flats as $flat){
                 $options .='<option value="'.$flat->id.'">'.$flat->flat_number.'</option>';
                 //$flat_nos[$flat->id] = $flat->flat_number;
             }
            // // print_r($flat_nos);
            // $msg =  array(
            //     'status'=>1,
            //     'data'=>$flat_nos
            // );
            // return response()->json($msg);
            echo $options;
         }
    }

    /**
     * User Registration  success 
     */
    public function regSuccess(Request $request){
        return view('users.success');
    }

    /**
     * to get flat number for ajax
     */
    public function selectSearch(Request $request)
    {
        $data =[];
        if($request->has('block')){
                $data = Flat::select("flat_number","id")
                        ->where('block_id','=',$request['block'])
                        ->where("flat_number","LIKE", "%".$request['query']."%")
                        ->groupBy('flat_number','id')->get();
        }
        return response()->json($data);
      
        // $flat_number = null;
        // if($data){
         
        //     foreach($data as $dat){
        //         $flat_number[]= $dat->flat_number;
        //     }
            
          
        // }
        // if(!empty($flat_number)){
        //      return response()->json($flat_number);
        // }else{
        //     return 'No';
        // }
        
    	
    }
}
