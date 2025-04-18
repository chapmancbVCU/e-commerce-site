<?php
namespace App\Models;
use Core\Model;
use Core\Validators\RequiredValidator;

/**
 * Implements features of the Transactions class.
 */
class Transactions extends Model {

    // Fields you don't want saved on form submit
    // public const blackList = [];

    // Set to name of database table.
    protected static $_table = 'transactions';

    // Soft delete
    protected static $_softDelete = true;
    
    // Fields from your database
    public $id;
    public $created_at;
    public $deleted_at;
    public $cart_id;
    public $gateway;
    public $type;
    public $amount;
    public $charge_id;
    public $success = 0;
    public $reason;
    public $card_brand;
    public $last4;
    public $name;
    public $shipping_address1;
    public $shipping_address2;
    public $shipping_city;
    public $shipping_state;
    public $shipping_zip;
    public $shipping_country;
    public $deleted = 0;

    public function afterDelete(): void {
        // Implement your function
    }

    public function afterSave(): void {
        // Implement your function
    }

    public function beforeDelete(): void {
        // Implement your function
    }

    public function beforeSave(): void {
        $this->timeStamps();
    }

    public function validateShipping() {
        $this->runValidation(new RequiredValidator($this, ['field' => 'name', 'message' => 'Name is required.']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'shipping_address1', 'message' => 'Address is required.']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'shipping_city', 'message' => 'City is required.']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'shipping_state', 'message' => 'State is required.']));
        $this->runValidation(new RequiredValidator($this, ['field' => 'shipping_zip', 'message' => 'Zip Code is required.']));
    }

    /**
     * Performs validation for the Transactions model.
     *
     * @return void
     */
    public function validator(): void {
        // Implement your function
    }
}
