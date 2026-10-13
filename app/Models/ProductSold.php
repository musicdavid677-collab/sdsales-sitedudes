<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSold extends Model
{
    protected $table = '121_client_product';
    //protected $primaryKey = 'pk_id';

    protected $fillable = ['product_id', 'customer_id'];

    function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    function customer()
    {
        return $this->belongsTo(Customer::class);
    }    
}
