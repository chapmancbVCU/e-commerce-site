<?php

namespace App\Lib\Gateways;
use Core\Lib\Utilities\Env;
use App\Lib\Gateways\{BraintreeGateway, StripeGateway};

class Gateway {
    public static function build() {
        if(Env::get('GATEWAY') == 'stripe') {
            return new StripeGateway();
        } else if(Env::get('GATEWAY') == 'braintree') {
            return new BraintreeGateway();
        }
    }
}