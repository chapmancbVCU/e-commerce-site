<?php
namespace App\Models;
use Core\Model;

/**
 * Implements features of the CartItems class.
 */
class CartItems extends Model {

    // Fields you don't want saved on form submit
    // public const blackList = [];

    // Set to name of database table.
    protected static $_table = 'cart_items';

    // Soft delete
    protected static $_softDelete = true;
    
    // Fields from your database
    public $id;
    public $product_id;
    public $cart_id;
    public $qty;
    public $updated_at;
    public $created_at;
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
        // Implement your function
    }

    /**
     * Performs validation for the CartItems model.
     *
     * @return void
     */
    public function validator(): void {
        // Implement your function
    }
}
