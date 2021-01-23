<?php

namespace App\Http\Helpers;
use GuzzleHttp\Exception\GuzzleException;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AppHelper
{

    public static function sendRegistrationOtp($name, $receipientno, $otp){
        $client = new \GuzzleHttp\Client();
        if ($receipientno) {
            $ch = curl_init();
            $user=env('MVAAYOO_USERNAME');
            $senderID=env('MVAAYOO_SENDERID');
            $user="manoj.p@netiapps.com:Netiapps839";
            $senderID="sahas";
          //  $msgtxt="this is test message , test";
            $msgtxt = "Dear $name your OTP for registration is $otp Rgds SGOWA";
            curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
            curl_exec($ch);
           
            curl_close($ch);
            $ch = curl_init();

            // $username = env('MVAAYOO_USERNAME');
            // $senderID = env('MVAAYOO_SENDERID');
            // $url = env('MVAAYOO_URL');
            // $recipientNo = $mobileNumber;
           
            // $msgtxt = "Dear $name your OTP for registration is $otp Rgds SGOWA";
           
            // try {
            //     $client->request('POST', $url,  ['form_params'=> [
            //         'user' => $username,
            //         'senderID' => $senderID,
            //         'receipientno' => $recipientNo,
            //         'msgtxt' => $msgtxt
            //     ]]);

            //     return true;
            // } catch (GuzzleException $e) {
            //     $message = $e->getMessage();
            //     throw new \Exception($message, $e->getCode());
            // }

        } else {
            throw new \Exception("Mobile number not available", Response::HTTP_PRECONDITION_FAILED);
        }
    }

    public static function sendActivationSms($name,$receipientno,$rndString){
         
        if ($receipientno) {

            $ch = curl_init();
            // $user=env('MVAAYOO_USERNAME'); //"manoj.p@netiapps.com:Netiapps839";
            // $senderID = env('MVAAYOO_SENDERID');
            $user="manoj.p@netiapps.com:Netiapps839";
            $senderID="sahas";
            $msgtxt = "Dear $name Welcome to Sahasra Grand your membership has been activated User name $receipientno and Password : $rndString";
           
            curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
            curl_exec($ch);
           
            curl_close($ch);
            $ch = curl_init();
        }
    }
}