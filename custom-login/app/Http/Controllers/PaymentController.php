<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentModel;
use App\Models\User;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
  public function create_vnpay_payment($id){
    $existing_order = Order::findOrFail($id);
    $owner_order = $existing_order->user;
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://localhost:8000/vnpay_return";
    $vnp_TmnCode = "8P4G7F3D";
    $vnp_HashSecret = "I8YCTHZ8K6VAYTCTRNFZJQHKO92AVPOC"; 
    
    // $vnp_TxnRef = $existing_order->id; 
    $vnp_TxnRef = $id;
    $vnp_OrderInfo = "Thanh toán hóa đơn cho hóa đơn số ".$id;
    $vnp_OrderType = "Laptop Shop";
    $vnp_Amount = $existing_order->total_money * 23000 * 100;
    $vnp_Locale = "VNI";
    $vnp_BankCode = "NCB";
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
    );
    
    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    }
    
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }
    
    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            return redirect($vnp_Url);
        }
  }

  public function vnpay_return(Request $request) {
    $vnp_HashSecret = "I8YCTHZ8K6VAYTCTRNFZJQHKO92AVPOC";
    $vnp_SecureHash = $request->input('vnp_SecureHash');
    $order_id = $request->input("vnp_TxnRef");
    $existing_order = Order::findOrFail($order_id);
    $existing_order->paid = true;
    $existing_order->update();

   
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }
    
    
    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $hashData = "";
    $i = 0;
    
    // Concatenate input data for hashing
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
    }
    
    
    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

    if ($secureHash == $vnp_SecureHash) {
        if ($_GET['vnp_ResponseCode'] == '00') {
            $payment = PaymentModel::create([
                'order_id'=>$order_id,
                'user_id'=>Auth::id(),
                'method'=>"VNPAY",
                "amount"=>$existing_order->total_money,
                "status"=>"success",
            ]);
            $mailService = new EmailService();
            if( $mailService->sendBillMail($existing_order)){
                return redirect()->route('orders.index')->with("message","Thanh toán thành công");
            }
          
        } else {
           return redirect()->back()->with("message","Thanhs toán không thành công");
        }
    } else {
        echo "Chu ky khong hop le";
    }
}

}


