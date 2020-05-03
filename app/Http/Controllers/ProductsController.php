<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function viewProducts(){

        $products = Product::all();
        return view('store.products',compact('products'));
    }

    public function viewProduct($product_id){
        $product = Product::find($product_id);
        //dd($product);
        return view('store.product',compact('product'));
    }

}
