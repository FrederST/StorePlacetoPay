<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Models\Order;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use WithoutMiddleware;


    public function testViewOrder()
    {
        // User of the database
        $user = User::find(1);

        //Petition to create preview order confirmation with product id and user logged
        $response = $this->actingAs($user)->call('GET', '/order', [
            "product_id"=>"1",
        ]);

        //Petition success ?
        $response->assertStatus(200);
    }

    public function testCreateOrder()
    {
        // User of the database
        $user = User::find(1);

        //Petition to create order with product id and user logged
        $response = $this->actingAs($user)->post('/createorder', 
        [
            "product_id"=>"1",
        ]);

        //Petition success ?
        $response->assertStatus(302);
         
        // Check new order in the database whit user_id
        $this->assertDatabaseHas('orders',[
            "user_id" => $user->id,
        ]);

    }

    public function testOrderReferenceId(){

        // User of the database
        $user = User::find(1);

        //First order of the user
        $orderSQL = Order::where('user_id',$user->id)->first();

        //Petition to order payment with order id and user logged
        $response = $this->actingAs($user)->get('/orderpayment/'.$orderSQL->id);

        //Petition success ?
        $response->assertStatus(200);
         
    }

    public function testRetryPayment(){

        // User of the database
        $user = User::find(1);

        //First order of the user
        $orderSQL = Order::where('user_id',$user->id)->Where('status',3)->first();

        //Petition to order retrypayment with order id and user logged
        $response = $this->actingAs($user)->call('GET', '/retrypayment', [
            "order_id"=>$orderSQL->id,
        ]);

        //Petition success ?
        $response->assertStatus(302);

    }


}
