<?php

namespace App\Http\Controllers;

use App\Http\Services\FatoorahServices;
use Illuminate\Http\Request;

class FatoorahController extends Controller
{
    private $fatoorahServices;
    public function __construct(FatoorahServices $fatoorahServices){

        $this->fatoorahServices = $fatoorahServices;
    }
    public function payOrder(){
        $data = [
            //Fill required data
            'CustomerName'       => 'fname lname',
            'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
            'InvoiceValue'       => '50',
            'CustomerEmail'      => 'abdelrhmanatwa39@gmail.com',
            'CallBackUrl'        => 'http://mayfatoorah_laravel.test/mayFatoorahGetway/public/api/PaymentCallback',
            'ErrorUrl'           => 'http://mayfatoorah_laravel.test/mayFatoorahGetway/public/api/PaymentError', 
            'Language'           => 'en', //or 'ar'
            'DisplayCurrencyIso' => 'SAR',
        ];


        return $this->fatoorahServices->sendPayment($data);
    }


    public function PaymentCallback(Request $request){

        $data = [
            'Key'     => $request->paymentId,
            'KeyType' => 'paymentId'
        ];

        return $this->fatoorahServices->getPaymentStatus($data);

        // The next step is to store data in the Database
    }

    public function PaymentError(Request $request){
        dd($request);
    }
    
}
