<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\OrderValidatorRequest;
use App\Models\Order;
use App\Models\Product;
use App\User;
use Dnetix\Redirection\PlacetoPay;
use DataTables;

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
        
    public function viewOrder(Request $request){
        $product = Product::find($request->product_id);
        $user = User::find($request->user()->id);
        
        return view('store.order',compact('user','product'));
    }

    public function createOrder(Request $request){

        $productSQL = Product::find($request->product_id);
        $userSQL = User::find($request->user()->id);
        $orderSQL = new Order();
        $orderSQL->user_id = $request->user()->id;
        $orderSQL->product_id = $request->product_id;
        $orderSQL->status = 1;
        $orderSQL->requestId = 1;
        $orderSQL->processUrl = 'waiting';
        $orderSQL->save();

        $reference = $orderSQL->id;
        $requestptp = [
            "buyer" => [
                "name" => $userSQL->name,
                "surname" => $userSQL->surname,
                "email" => $userSQL->email,
                "mobile" => $userSQL->mobile,
            ], 
            'payment' => [
                'reference' => $reference,
                'description' => $productSQL->name,
                'amount' => [
                    'currency' => 'COP',
                    'total' => $productSQL->value,
                ],
            ],
            'expiration' => date('c', strtotime('+1 days')),
            'returnUrl' => url("orderpayment/{$reference}"),
            'ipAddress' => '127.0.0.1',
            'userAgent' => $request->user_agent,
        ];

        $response = $this->placetopay->request($requestptp);

        if ($response->isSuccessful()) {
            $orderSQL->requestId = $response->requestId;
            $orderSQL->processUrl = $response->processUrl;
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
                $productSQL = Product::find($orderSQL->product_id);
                $userSQL = User::find($orderSQL->user_id);
                return view('store.orderpayment',compact('orderSQL','productSQL','userSQL'));
            }else if($response->status()->status() == 'PENDING'){
                // The payment pending approval
                $orderSQL->status = 4;
                $orderSQL->save();
                $productSQL = Product::find($orderSQL->product_id);
                $userSQL = User::find($orderSQL->user_id);
                return view('store.orderpayment',compact('orderSQL','productSQL','userSQL'));
            }else if($response->status()->status() == 'REJECTED'){
                $orderSQL->status = 3;
                $orderSQL->save();
                $productSQL = Product::find($orderSQL->product_id);
                $userSQL = User::find($orderSQL->user_id);
                return view('store.orderpayment',compact('orderSQL','productSQL','userSQL'));
            }else{
                $productSQL = Product::find($orderSQL->product_id);
                $userSQL = User::find($orderSQL->user_id);
                return view('store.orderpayment',compact('orderSQL','productSQL','userSQL'));
            }
        } else {
            // There was some error with the connection so check the message
            dd($response->status()->message());
        }
    }

    public function userOrders(Request $request){
        $ordersSQL = Order::where('user_id',$request->user()->id);
        
        return Datatables::of($ordersSQL)->toJson();
    }

}
