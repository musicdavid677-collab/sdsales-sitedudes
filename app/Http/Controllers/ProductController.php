<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSold;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	public function index()
    {
        return view('product/list', [
            'products' => Product::cursor()
        ]);
    }
    	
    public function all(Request $request)
    {
    	/*
    	$productSolds = \App\ProductSold::with('product')
            ->where(['customer_id' => $request->get('customer_id')])
            ->get();
            '9610'
        */
        $productSoldTable = ProductSold::where('customer_id', $request->get('customer_id'))->get()->toArray();
        $productSold = array_map(function($p) {
        	return $p['product_id'];
        }, $productSoldTable);
        
        //dd($a);
        //dd(Product::where(['customer_id' => $customer_id])->with('product_sold')->get());
        return view('product/_all', [
            'products' => Product::cursor(),
            'productSold' => $productSold
        ]);
    }
}
