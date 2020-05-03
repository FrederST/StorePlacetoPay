<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\OrderValidatorRequest;
use App\Models\Order;
use Dnetix\Redirection\PlacetoPay;

class OrderController extends Controller
{

    protected $placetopay;

    public function __construct() 
    {
        $this->placetopay = new PlacetoPay([
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url' => 'https://test.placetopay.com/redirection/',
            'rest' => [
                'timeout' => 45, // (optional) 15 by default
                'connect_timeout' => 30, // (optional) 5 by default
            ]
        ]);
    }
        
    public function viewOrder(OrderValidatorRequest $request){
        $order = $request;
        
        return view('store.order',compact('order'));
    }

    public function createOrder(Request $request){

        $orderSQL = new Order();
        $orderSQL->customer_name = $request->customer_name;
        $orderSQL->customer_surname = $request->customer_surname;
        $orderSQL->customer_email = $request->customer_email;
        $orderSQL->customer_mobile = $request->customer_mobile;
        $orderSQL->status = 1;
        $orderSQL->requestId = 1;
        $orderSQL->save();

        $reference = $orderSQL->id;
        $requestptp = [
            "buyer" => [
                "name" => $orderSQL->customer_name,
                "surname" => $orderSQL->customer_surname,
                "email" => $orderSQL->customer_email,
                "mobile" => $orderSQL->customer_mobile,
            ], 
            'payment' => [
                'reference' => $reference,
                'description' => $request->product_name,
                'amount' => [
                    'currency' => 'COP',
                    'total' => $request->product_value,
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => 'http://127.0.0.1:8000/orderpayment/'. $reference,
            'ipAddress' => '127.0.0.1',
            'userAgent' => $request->user_agent,
        ];

        $response = $this->placetopay->request($requestptp);

        if ($response->isSuccessful()) {
            $orderSQL->requestId = $response->requestId;
            $orderSQL->save();
            return new RedirectResponse($response->processUrl());
        } else {
            $response->status()->message();
        }
    }

    public function getOrderReferenceId($reference){

        $orderSQL = Order::find($reference);
        $response = $this->placetopay->query($orderSQL->requestId);

        if ($response->isSuccessful()) {
            
            if ($response->status()->isApproved()) {
                // The payment has been approved
                $orderSQL->status = 2;
                $orderSQL->save();
                return view('store.orderpayment',compact('orderSQL'));
            }
        } else {
            // There was some error with the connection so check the message
            dd($response->status()->message());
        }
    }

}
