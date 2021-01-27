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
use App\Block;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRegistrationOTP;
use App\Mail\ActivationOTP;
use Illuminate\Validation\Rule; 

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

        $isFlatExists = $this->checkFlat($request);
        if($isFlatExists == true){
           
            $type =  $request->input('type');
            $msg = [
                'status'=> 0,
                'message' => 'This flat has been registered a '. $type
            ];
            return response()->json($msg);
        }

        AppHelper::sendRegistrationOtp($request->input('name'), $request->input('mobile'), $sixRandomDigit);
        $user = new User();
        $user->name = $request->input('name');
        $user->email= $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->block_id = $request->input('block');
        $user->flat_id = $request->input('flat_number');
        $user->type = $request->input('type');
        $user->otp = $sixRandomDigit;
        $user->role = $request->input('type');
        $user->save();
       
        if($user){
            if($user->email!=''){
                Mail::to($user->email)->send(new SendRegistrationOTP($user));
            }
            $msg = [
                'status'=> 1,
                'message' => 'Success',
                'data' => $user
            ];
            return response()->json($msg);
           
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
        $user = User::find($id);
        $blocks = Block::all();
        $flats = Flat::where('block_id','=',$user->block_id)->get();
        return view('users.edit',compact(['user','blocks','flats']));
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
      

        $request->validate([
            'name' => 'required',
            'email' => [
                     'required','email',Rule::unique('users')->where(function($query) use($id)  {
                        $query->where('active', '=', 1);
                        $query->where('id', '!=', $id);
                  })
             ],
            'mobile' => 'required|digits:10|regex:/^[0-9]/',
            'block_id' => 'required',
            'flat_id' => [
                'required',Rule::unique('users')->where(function($query) use ($request,$id) {
                   $query->where('active', '=', 1);
                   $query->where('type', '=', $request->input('type'));
                   $query->where('block_id','=',$request->input('block_id'));
                   $query->where('flat_id','=',$request->input('flat_id'));
                   $query->where('id','!=',$id);
             }),
             
        ],
        ['flat_id.unique' => __('messages.unique', ['Already Exists'])],
        'type' => 'required'           
        ]);

        
        $user =User::find($id);
        $user->name = $request->input('name');
        $user->email= $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->block_id = $request->input('block_id');
        $user->flat_id = $request->input('flat_id');
        $user->type = $request->input('type');
        //$user->otp = $sixRandomDigit;
        $user->role = $request->input('type');
        $user->save();
        
        return redirect('/admin/user-list');
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
        $user = User::find($id);
        $user->delete();
        return redirect('/admin/user-list');
    }

    /**
     * To check flat is already registered or not
     */

    public function checkFlat(Request $request){
       

        $isFlatExist = User::where('block_id','=',$request->input('block'))
        ->where('flat_id','=',$request->input('flat_number'))
        ->where('type','=',$request->input('type'))
        ->where('active','=',1)->first();
       
        if($isFlatExist){
           return true;
        }else{
            return false;
        }
    }

    /**
     * to check mobile duplication
     */
 
    public function checkMobile(Request $request){
        if($_POST['mobile'] != ''){
            $isMobileExist = User::where('mobile',$_POST['mobile'])
            ->where('mobile_verified_at','!=', '')
            ->where('active','=',1)->first();
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
            ->where('mobile_verified_at','!=', '')
            ->where('active','=',1)->first();
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
                        'password' => $request->password,
                        'active' => 1,
                    ],true)
                    || Auth::attempt([
                        'mobile' => $request->username,
                        'password' => $request->password,
                        'active' => 1,
                    ],true)){
                
            $user = User::where('email', '=', $request->username  )
                       ->orWhere('mobile' , '=', $request->username)
                       ->where('active','=',1)->first();
        
             // $token = $user->createToken('access_token')->accessToken;
            //$user->remember_token = $token;
            if($user){
                $user->save();
                $msg =  array(
                    'status'=>1,
                    'message'=>'Success',
                    'type'=>$user['type']
                );
                return response()->json($msg);
            }
           
        }

        $msg =  array(
            'status'=>0,
            'message'=>'Failed',
            'type'=>Null
        );
        return response()->json($msg);
    
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
     	
    }

    public function changeUserStatus(Request $request){

        $status = $request->input('status');
        if($status == 1){
            $rndString = mt_rand(100000,999999);
            $hashed_password = Hash::make($rndString);
            $user = User::find($_POST['userid']);
            $user->active = 1;
            $user->password = $hashed_password;
            $user->save();
            //$user = User::where('id',$_POST['userid'])->update(array('active' => 1,'password' => $hashed_password));
           
            AppHelper::sendActivationSms($user['name'],$user['mobile'], $rndString);
            Mail::to($user->email)->send(new ActivationOTP($user, $rndString));
         
            if($user){
                $msg =  array(
                    'status'=>1,
                    'message'=>'Successfully Activated'
                );
                return response()->json($msg);
            }
        }else{
            $user = User::find($_POST['userid']);
            $user->active = 0;
            $user->save();
            if($user){
                $msg =  array(
                    'status'=>1,
                    'message'=>'Successfully De-Activated'
                );
                return response()->json($msg);
            }
        }

        // $rndString = mt_rand(100000,999999);
        // $hashed_password = Hash::make($rndString);
        // $user = User::find($_POST['userid']);
        // $user->active = 1;
        // $user->password = $hashed_password;
        // $user->save();
        // //$user = User::where('id',$_POST['userid'])->update(array('active' => 1,'password' => $hashed_password));
       
        // AppHelper::sendActivationSms($user['name'],$user['mobile'], $rndString);
     
        // if($user){
        //     $msg =  array(
        //         'status'=>1,
        //         'message'=>'Success'
        //     );
        //     return response()->json($msg);
        // }

    }
}
