<?php

namespace App\Lib\Gateways;
use App\Models\Carts;

abstract class AbstractGateway {
    public $cart_id;
    public $items;
    public $item_count = 0;
    public $subTotal = 0;
    public $shippingTotal = 0;
    public $grandTotal = 0;
    public $chargeSuccess = false;
    public $msgToUser = '';

    public function __construct($cart_id) {
        $this->cart_id = $cart_id;
        $this->items = Carts::findAllItemsByCartId($cart_id);

        foreach($this->items as $item) {
            $this->item_count += $item->qty;
            $this->subTotal += ($item->price * $item->qty);
            $this->shippingTotal += ($item->shipping * $item->qty);
        }

        $this->grandTotal = $this->subTotal + $this->shippingTotal;
    }

    abstract public function getView();

    abstract public function processForm($post);

    abstract public function charge($data);

    abstract public function handleChargeResponse($ch);

    abstract public function createTransaction($ch);

    abstract public function getToken();
}