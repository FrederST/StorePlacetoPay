<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    // Show all products of the store
    public function viewProducts(){
        $products = Product::all();
        return view('store.products',compact('products'));
    }

    // Show products specifict of the store
    public function viewProduct($product_id){
        $product = Product::find($product_id);
        return view('store.product',compact('product'));
    }

}
