<?php

namespace App\Lib\Gateways;
use App\Lib\Gateways\AbstractGateway;
use Braintree\Gateway;
use Core\Lib\Utilities\Env;
use App\Models\Transactions;
use App\Models\Carts;

class BraintreeGateway extends AbstractGateway {
    public function getView() {
        return 'card_forms/braintree';
    }

    public function processForm($post) {

    }

    public function charge($data) {

    }

    public function handleChargeResponse($ch) {

    }

    public function createTransaction($ch) {

    }

    public function getToken()
    {
        $gw = new Gateway([
            'environment' => Env::get('BRAINTREE_ENV'),
            'merchantId' => Env::get('BRAINTREE_MERCHANT_ID'),
            'publicKey' => Env::get('BRAINTREE_PUBLIC'),
            'privateKey' => Env::get('BRAINTREE_PRIVATE')
        ]);

        $token = $gw->clientToken()->generate();
        return $token;
    }
}