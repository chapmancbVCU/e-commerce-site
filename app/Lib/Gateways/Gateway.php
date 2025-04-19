<?php

namespace App\Lib\Gateways;
use App\Lib\Gateways\{StripeGateway};
use Core\Lib\Utilities\Env;

class Gateway {
    public static function build($cart_id) {
        if(Env::get('GATEWAY') == 'stripe') {
            return new StripeGateway($cart_id);
        }
    }
}