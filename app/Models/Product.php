<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = '121_products';

    function getProduct(): string
    {
        return strtolower(
            strtr($this->product, [
                ' ' => '-', 
                '(' => '', 
                ')' => ''
            ])
        );
    }

    public function product_sold()
    {
        return $this->hasMany(ProductSold::class);
    }
}
