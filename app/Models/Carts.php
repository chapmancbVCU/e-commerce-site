<?php
namespace App\Models;
use Core\Model;
use Core\Cookie;
use Core\Lib\Utilities\Env;

/**
 * Implements features of the Carts class.
 */
class Carts extends Model {

    // Fields you don't want saved on form submit
    // public const blackList = [];

    // Set to name of database table.
    protected static $_table = 'carts';

    // Soft delete
    protected static $_softDelete = true;
    
    // Fields from your database
    public $id;
    public $created_at;
    public $updated_at;
    public $purchased = 0;
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

    public static function findCurrentCartOrCreateNew() {
        if(!Cookie::exists(Env::get('CART_COOKIE_NAME'))) {
            $cart = new Carts();
            $cart->save();
        } else {
            $cart_id = Cookie::get(Env::get('CART_COOKIE_NAME'));
            $cart = self::findById((int)$cart_id);
        }
        Cookie::set(Env::get('CART_COOKIE_NAME'), $cart->id, Env::get('CART_COOKIE_EXPIRY'));
        return $cart;
    }

    public static function findAllItemsByCartId($cart_id) {
        $params = [
            'columns' => 'cart_items.*, p.name, p.price, p.shipping, pi.url',
            'joins' => [
                ['products', 'p.id = cart_items.product_id', 'p'],
                ['product_images', 'p.id = pi.product_id', 'pi']
            ],
            'conditions' => 'cart_items.cart_id = ? AND pi.sort = 0 AND cart_items.deleted = 0',
            'bind' => [$cart_id]
        ];
    
        // Call DB directly to skip soft delete logic
        return static::getDb()->find('cart_items', $params, static::class) ?: [];
    }

    /**
     * Performs validation for the Carts model.
     *
     * @return void
     */
    public function validator(): void {
        // Implement your function
    }
}
