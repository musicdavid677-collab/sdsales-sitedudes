<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSold;
use Illuminate\Http\Request;

class ProductSoldController extends Controller
{
	public function index()
    {
    	return;
    }
    
    public function create(Request $request)
    {
    	return view('product-sold/create');
    }
    
    public function store(Request $request)
    {    	
    	if ($request->get('client_id') === null) {
    		abort(404, 'Client ID is not define');
    	}
    	
		$this->_productSoldModel($request->get('client_id'))->create($request->all());
    		
    	$productSoldModel = $this->_productSoldModel($customer_id)->with('product')->get();

    	return view('product-sold/view', ['productSoldModel' => $productSoldModel]);
    }
    
	public function view(Request $request, $customer_id)
    {
        $productSoldModel = $this->_productSoldModel($customer_id)->with('product')->get();
            
        return view('product-sold/view', [
            'productSoldModel' => $productSoldModel,
            'customer_id' => $customer_id
        ]);
	}
    
	public function edit($customer_id)
    {
        $productSoldTable = $this->_productSoldModel($customer_id)->get()->toArray();
        $productSold = array_map(function($p) {
        	return $p['product_id'];
        }, $productSoldTable);
        
        return view('product-sold/edit', [
            'products' => Product::cursor(),
            'productSold' => $productSold,
            'customer_id' => $customer_id
        ]);
    }
    
    public function update(Request $request, $productSoldId)
    {    	
    	$product_id = $request->product;
    	$client_id = $request->get('client_id');
    	
    	// user unchecked the checked checkbox
    	if ($request->get('product_current_status') === 'checked') {
    		$this->_productSoldModel($client_id)->where('product_id', $productSoldId)->delete();
    		return;
    	}

		$this->_productSoldModel($client_id)->create([
            'customer_id' => $client_id,
            'product_id' => $product_id
        ]);
    	return;
    }
    
    protected function _productSoldModel($client_id)
    {
    	return ProductSold::where('customer_id', $client_id);
    }
}
