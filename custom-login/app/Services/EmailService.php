<?php 

namespace App\Services;

use App\Mail\BillMail;
use App\Mail\testMail;
use Illuminate\Support\Facades\Mail;


class EmailService{

    public function sendWelcomeMail($user)
    {
        try {
            $toEmail = $user->email;
            $message = "Hello ". $user->name;
            $subject = "Welcome to Blue shop";

            if(Mail::to($toEmail)->send(new testMail($message, $subject))){
              return true;
            }else{
              return false;
            }
           
        } catch (\Exception $e) {
        return false;
        }
    }

    public function sendBillMail($order){
        try{
           $toEmail = $order->email;
           if(Mail::to($toEmail)->send(new BillMail($order))){
            return true;
           }
           else{
            return false;
           }
        }catch (\Exception $e) {
            return false;
        }
    }
}
