<?php

namespace App\Http\Helpers;
use GuzzleHttp\Exception\GuzzleException;
use http\Client;

class AppHelper
{

    public static function sendRegistrationOtp($name, $mobileNumber, $otp){
        $client = new \GuzzleHttp\Client();
        if ($mobileNumber) {
            // $ch = curl_init();
            // $user="manoj.p@netiapps.com:Netiapps839";
            // $receipientno="9943308193";
            // $senderID="eecbuy";
            // $msgtxt="this is test message , test";
            // curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($ch, CURLOPT_POST, 1);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
            // $buffer = curl_exec($ch);
            // if(empty ($buffer))
            // { echo " buffer is empty "; }
            // else
            // { echo $buffer; }
            // curl_close($ch);
            // $ch = curl_init();

            $username = env('MVAAYOO_USERNAME');
            $senderID = env('MVAAYOO_SENDERID');
            $url = env('MVAAYOO_URL');
            $recipientNo = $mobileNumber;
           
            $msgtxt = "Dear $name your OTP for registration is $otp Rgds SGOWA";
            try {
                $client->request('POST', $url,  ['form_params'=> [
                    'user' => $username,
                    'senderID' => $senderID,
                    'receipientno' => $recipientNo,
                    'msgtxt' => $msgtxt
                ]]);

                return true;
            } catch (GuzzleException $e) {
                $message = $e->getMessage();
                throw new \Exception($message, $e->getCode());
            }

        } else {
            throw new \Exception("Mobile number not available", Response::HTTP_PRECONDITION_FAILED);
        }
    }
}