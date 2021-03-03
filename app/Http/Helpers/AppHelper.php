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

            // $username = "manoj.p@netiapps.com";
            // $hash = "c036e85abe2efe9d3ccce6f9495dc320778f5d56370424f1bf602135d9efd4f8";

            $username =  env('TEXTLOCAL_USERNAME');
            $hash =  env('TEXTLOCAL_HASH');
        
            // Config variables. Consult http://api.textlocal.in/docs for more info.
            $test = "0";
        
            // Data for text message. This is the text message data.
            $sender = "sahasr"; // This is who the message appears to be from.
            $numbers = $receipientno; // A single number or a comma-seperated list of numbers
            $message = "Dear $name your OTP for registration is $otp Rgds SGOWA";
            // 612 chars or less
            // A single number or a comma-seperated list of numbers
            $message = urlencode($message);
            $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
            $ch = curl_init('http://api.textlocal.in/send/?');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch); // This is the result from the API
            curl_close($ch);

        } else {
            throw new \Exception("Mobile number not available", Response::HTTP_PRECONDITION_FAILED);
        }
    }

    public static function sendActivationSms($name,$receipientno,$rndString){
         
        if ($receipientno) {

            $username =  env('TEXTLOCAL_USERNAME');
            $hash =  env('TEXTLOCAL_HASH');

            $test = "0";
             // Data for text message. This is the text message data.
             $sender = "sahasr"; // This is who the message appears to be from.
             $message = "Dear $name, Welcome to Sahasra Grand your membership has been activated User name $receipientno and Password: $rndString";
             // 612 chars or less
             // A single number or a comma-seperated list of numbers
             $message = urlencode($message);
             $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$receipientno."&test=".$test;
             $ch = curl_init('http://api.textlocal.in/send/?');
             curl_setopt($ch, CURLOPT_POST, true);
             curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             $result = curl_exec($ch); // This is the result from the API
             curl_close($ch);

        }
    }

    public static function BookingConfirmation($name,$receipientno,$rndString,$amenity){
        if ($receipientno) {

            $username =  env('TEXTLOCAL_USERNAME');
            $hash =  env('TEXTLOCAL_HASH');

             $test = "0";
             $sender = "sahasr"; // This is who the message appears to be from.
             $message = "Dear $name your booking for $amenity is Approved. Your Refference iD is $rndString. Rgds SGOWA";
             $message = urlencode($message);
             $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$receipientno."&test=".$test;
             $ch = curl_init('http://api.textlocal.in/send/?');
             curl_setopt($ch, CURLOPT_POST, true);
             curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             $result = curl_exec($ch); // This is the result from the API
             curl_close($ch);  
        }
    }

    public static function sendForgotPasswordOtp($name,$receipientno,$rndString){
        if ($receipientno) {
            $username =  env('TEXTLOCAL_USERNAME');
            $hash =  env('TEXTLOCAL_HASH');

             $test = "0";
             $sender = "sahasr"; // This is who the message appears to be from.
             $message = "Dear $name your password has been reset. Your new password is $rndString Rgds SGOWA";
             $message = urlencode($message);
             $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$receipientno."&test=".$test;
             $ch = curl_init('http://api.textlocal.in/send/?');
             curl_setopt($ch, CURLOPT_POST, true);
             curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             $result = curl_exec($ch); // This is the result from the API
             curl_close($ch);            
        }
    }

    // this is for namination sms sending
    public static function nominationSms($name, $receipientno, $postname){

        if ($receipientno) {

            $username =  env('TEXTLOCAL_USERNAME');
            $hash =  env('TEXTLOCAL_HASH');

             $test = "0";
             $sender = "sahasr"; // This is who the message appears to be from.
             $message = "Dear $name your Nomination for $postname position is filed and awaiting approval Rgds SGOWA";
             $message = urlencode($message);
             $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$receipientno."&test=".$test;
             $ch = curl_init('http://api.textlocal.in/send/?');
             curl_setopt($ch, CURLOPT_POST, true);
             curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             $result = curl_exec($ch); // This is the result from the API
             curl_close($ch);

        }
    }

    // this is for namination finalized ( Accepted or Rejected ) sms sending
    public static function nominationFinalizedSms($name, $receipientno, $postname, $status){

        if ($receipientno) {

             $username =  env('TEXTLOCAL_USERNAME');
             $hash =  env('TEXTLOCAL_HASH');
             $test = "0";
             $sender = "sahasr"; // This is who the message appears to be from.
             if($status == 2){
                $message = "Dear $name your Nomination for the $postname position is Approved Rgds SGOWA";
             }
             if($status == 0){
                $message = "Dear $name your Nomination for the $postname position has been rejected, Thank you for your applying. Rgds SGOWA";
             }
             $message = urlencode($message);
             $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$receipientno."&test=".$test;
             $ch = curl_init('http://api.textlocal.in/send/?');
             curl_setopt($ch, CURLOPT_POST, true);
             curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             $result = curl_exec($ch); // This is the result from the API
             curl_close($ch);

        }
    }
}