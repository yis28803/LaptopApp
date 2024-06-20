<?php

namespace App\Http\Controllers;

use App\Mail\testMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailConTroller extends Controller
{
    public function sendWelcomeMail()
    {
        try {
            $toEmail = "chikha13122@gmail.com";
            $message = "hello chikha nha";
            $subject = "welcome to laptop shop cua kha nha";

            if(Mail::to($toEmail)->send(new testMail($message, $subject))){
                return redirect()->route('home')->with('success', 'Email sent successfully!');
            }else{
                return "haah";
            }
           
        } catch (\Exception $e) {
          echo $e;
        }
    }

    public function sendBillMail($id){
            return $id;
    }
}
