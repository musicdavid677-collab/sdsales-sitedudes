<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSoldLead extends Model
{
    protected $table = '121_client_product_marshalled';
    //protected $primaryKey = 'pk_id';

    protected $fillable = ['product_id', 'customer_id'];

    function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    function lead()
    {
        return $this->belongsTo(Lead::class);
    }    
}
