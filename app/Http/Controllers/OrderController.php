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
        // Configuration required for that instance.
        $this->placetopay = new PlacetoPay([
            'login' => env('LOGIN', '6dd490faf9cb87a9862245da41170ff2'),
            'tranKey' => env('TRANKEY', '024h1IlD'),
            'url' => 'https://test.placetopay.com/redirection/',
            'rest' => [
                'timeout' => 45, // (optional) 15 by default
                'connect_timeout' => 30, // (optional) 5 by default
            ]
        ]);
    }
     
    // Return summary of order receives product_id and user_id of user logged
    public function viewOrder(Request $request){
        $product = Product::find($request->product_id);
        $user = User::find($request->user()->id);
        
        return view('store.order',compact('user','product'));
    }

    // Create order and redirect of PlaetoPay for payment receives product_id and user_id of user logged
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
            //'userAgent' => $request->user_agent,
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
        ];

        $response = $this->placetopay->request($requestptp);

        if ($response->isSuccessful()) {
            $orderSQL->requestId = $response->requestId;
            $orderSQL->processUrl = $response->processUrl;
            $orderSQL->save();
            return new RedirectResponse($response->processUrl());
        } else {
            \Log::info($response->status()->message());   
        }
    }

    //Verify in placetopay status of order and modific and to show status of payment
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
                // The payment has been rejected
                $orderSQL->status = 3;
                $orderSQL->save();
                $productSQL = Product::find($orderSQL->product_id);
                $userSQL = User::find($orderSQL->user_id);
                return view('store.orderpayment',compact('orderSQL','productSQL','userSQL'));
            }else{
                // The payment pending for payment
                $productSQL = Product::find($orderSQL->product_id);
                $userSQL = User::find($orderSQL->user_id);
                return view('store.orderpayment',compact('orderSQL','productSQL','userSQL'));
            }
        } else {
            // There was some error with the connection so check the message
            dd($response->status()->message());
        }
    }

    // Return orders of specific user in JSON
    public function userOrders(Request $request){
        $ordersSQL = Order::where('user_id',$request->user()->id)->with('product');
        
        return Datatables::of($ordersSQL)->toJson();
    }

    // Return all orders of the store in JSON
    public function allOrders(){
        $ordersSQL = Order::with('product');  
        return Datatables::of($ordersSQL)->toJson();
    }

    // Show all orders of the store
    public function viewAllOrders(){
        return view('store.allorders');
    }

    //Retry payment of specifict order receives order_id and user_id of user logged
    public function retryPayment(Request $request){

        $orderSQL = Order::find($request->order_id);
        $productSQL = Product::find($orderSQL->product_id);
        $userSQL = User::find($request->user()->id);
        
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
            //'userAgent' => $request->user_agent,
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
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

}
