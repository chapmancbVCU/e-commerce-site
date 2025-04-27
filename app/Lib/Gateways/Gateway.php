<?php

namespace App\Lib\Gateways;
use Core\Lib\Utilities\Env;
use App\Lib\Gateways\{BraintreeGateway, StripeGateway};

class Gateway {
    public static function build($cart_id) {
        if(Env::get('GATEWAY') == 'stripe') {
            return new StripeGateway($cart_id);
        } else if(Env::get('GATEWAY') == 'braintree') {
            return new BraintreeGateway($cart_id);
        }
    }
}