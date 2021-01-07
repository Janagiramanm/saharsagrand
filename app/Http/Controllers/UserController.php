<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        
        return view('users.create');
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
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => 'required|digits:10|regex:/^[0-9]/',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
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

        return view('users.regOtp',compact(['userId']));

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
}
