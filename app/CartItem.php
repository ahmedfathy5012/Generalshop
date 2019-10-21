<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    
    /**
     * @var $product product
     */
    public $product;
    public $qty;

    public function __construct(product $product , $qty)
    {
        $this->product = $product;
        $this->qty = $qty;
    }
}
