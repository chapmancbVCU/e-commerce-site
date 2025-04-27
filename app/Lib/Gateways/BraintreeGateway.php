<?php

namespace App\Lib\Gateways;
use App\Lib\Gateways\AbstractGateway;
use Braintree\Gateway;
use Core\Lib\Utilities\Env;
use App\Models\Transactions;
use App\Models\Carts;

class BraintreeGateway extends AbstractGateway {
    public static $gateway = 'braintree';

    public function getView() {
        return 'card_forms/braintree';
    }

    public function processForm($post) {
        $ch = $this->charge($post);
        $this->handleChargeResponse($ch);
        $tx = $this->createTransaction($ch);
        
        if($this->chargeSuccess) {
            Carts::purchaseCart($this->cart_id);
        }

        return [
            'success' => $this->chargeSuccess,
            'message' => $this->msgToUser,
            'tx' => $tx,
            'charge_id' => $ch->transaction->id
        ];
    }

    public function charge($data) {
        $gw = $this->getGateway();
        return $gw->transaction()->sale([
            'amount' => $this->grandTotal,
            'paymentMethodNonce' => $data['payment_method_nonce'],
            'shipping' => $this->parseShippingAddress($data),
            'options' => ['submitForSettlement' => true],
            'customFields' => ['cart_id' => $this->cart_id]
        ]);
    }

    public function handleChargeResponse($ch) {
        $this->chargeSuccess = $ch->success;
        $this->msgToUser = $ch->transaction->processorResponseText;
    }

    public function createTransaction($ch) {
        $tx = new Transactions();
        $tx->cart_id = $this->cart_id;
        $tx->gateway = static::$gateway;
        $tx->type = $ch->transaction->paymentInstrumentType;
        $tx->amount = $this->grandTotal;
        $tx->success = ($this->chargeSuccess) ? 1 : 0;
        $tx->charge_id = $ch->transaction->id;
        $tx->reason = $ch->transaction->gatewayRejectionReason;
        $tx->card_brand = $ch->transaction->creditCard['cardType'];
        $tx->last4 = $ch->transaction->creditCard['last4'];
        $tx->name = $ch->transaction->shipping['company'];
        $tx->shipping_address1 = $ch->transaction->shipping['streetAddress'];
        $tx->shipping_address2 = $ch->transaction->shipping['extendedAddress'];
        $tx->shipping_city = $ch->transaction->shipping['locality'];
        $tx->shipping_state = $ch->transaction->shipping['region'];
        $tx->shipping_zip = $ch->transaction->shipping['postalCode'];
        $tx->shipping_country = $ch->transaction->shipping['countryName'];
        $tx->save();
        return $tx;
    }

    protected function parseShippingAddress($data) {
        return [
            'company' => $data['name'],
            'streetAddress' => $data['shipping_address1'],
            'extendedAddress' => $data['shipping_address2'],
            'locality' => $data['shipping_city'],
            'region' => $data['shipping_state'],
            'postalCode' => $data['shipping_zip']
        ];
    }

    public function getToken()
    {
        $gw = $this->getGateway();
        $token = $gw->clientToken()->generate();
        return $token;
    }

    protected function getGateway() {
        return new Gateway([
            'environment' => Env::get('BRAINTREE_ENV'),
            'merchantId' => Env::get('BRAINTREE_MERCHANT_ID'),
            'publicKey' => Env::get('BRAINTREE_PUBLIC'),
            'privateKey' => Env::get('BRAINTREE_PRIVATE')
        ]);
    }
}