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
    public $qty = 0;
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
        $this->timeStamps();
    }

    public static function findByProductIdOrCreate($cart_id, $product_id) {
        $item = self::findFirst([
            'conditions' => 'cart_id = ? AND product_id = ?',
            'bind' => [$cart_id, $product_id]
        ]);

        if(!$item) {
            $item = new self();
            $item->cart_id = $cart_id;
            $item->product_id = $product_id;
            $item->save();
        }
        return $item;
    }

    public static function addProductToCart($cart_id, $product_id) {
        $product = Products::findById((int)$product_id);
        if($product) {
            $item = self::findByProductIdOrCreate($cart_id, $product_id);
        }
        return $item;
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
