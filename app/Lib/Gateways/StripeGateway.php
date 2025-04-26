<?php

namespace App\Lib\Gateways;
use Stripe\Charge;
use Stripe\Stripe;
use Core\Lib\Utilities\Env;
use App\Lib\Gateways\AbstractGateway;

class StripeGateway extends AbstractGateway {
    public function getView() {
        return 'card_forms/stripe';
    }

    public function processForm($post) {
        $data = [
            'amount' => $this->grandTotal * 100,
            'currency' => 'usd',
            'description' => 'Chappy.php Purchase: ' . $this->item_count .  'items. Cart ID: ' . $this->cart_id,
            'source' => $post['stripeToken']
        ];

        $ch = $this->charge($data);
    }

    public function charge($data) {
        Stripe::setApiKey(Env::get('STRIPE_PRIVATE'));
        $charge = Charge::create($data);
        return $charge;
    }

    public function handleChargeResponse($ch) {}

    public function createTransaction($ch) {}
}