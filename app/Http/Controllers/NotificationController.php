<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\User;
use App\Message;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::paginate(5);
        return view('notifications.index',compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $users = User::where('type', '!=', 'superadmin')
        ->where('active', '=', 1)->get();

        $templates = Message::where('active','=',1)->get();
        return view('notifications.create',compact(['users','templates']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_type' => 'required',
            'user_id' => 'required'
        ]);
        echo '<pre>';
        print_r($request->input());
        exit;
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

    public function selectUsers(Request $request){
        $user_type = $request->input('type');
      
        $users = User::when($user_type, function ($q) use ($user_type){
            if($user_type != 'all'){
               return $q->where('type', '=', $user_type);
            }else{
                return $q->where('type', '!=', 'superadmin');
            }

        })->where('active','=',1)->paginate('10');

        if($users->isNotEmpty()){
            $result = '<select id="user-selectbox" required name="user_id[]">';
            foreach($users as $user){
                  $result .= '<option value="'.$user->id.'">'.$user->name.' - '.( $user->flat->flat_number ? $user->flat->flat_number: '')  .'</option>';
            }
            $result .='</select>'; 
            $msg = [
                'status'=> 1,
                'data' => $result
            ];
            return response()->json($msg);
        }else{
            $msg = [
                'status'=> 0,
                'data' => NULL
            ];
            return response()->json($msg);
        }

    }

    public function getSmsTemplate(Request $request){
        $id = $request->input('id');
       
        $template = Message::where('id','=',$id)->first();
        // echo '<pre>';
        // print_r($template);
        // exit;
        if($template){
          
                $result = '
                                <div>SMS Content</div>
                                <div>'.$template->sms.'</div>
                                <div>Email Content</div>
                                <div>'.$template->email.'</div>
                         ';
            
            $msg = [
                'status'=> 1,
                'data' => $result
            ];
            return response()->json($msg);
        }

        $msg = [
            'status'=> 0,
            'data' => 'No Content Found.'
        ];
        return response()->json($msg);
       
    }
}
