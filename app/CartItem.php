<?php

namespace App;



class CartItem
{

    /**
     * @var $product product
     */
    public $product;
    public $qty;

    public function __construct(product $product , $qty = 1)
    {
        $this->product = $product;
        $this->qty = $qty;

    }
}
