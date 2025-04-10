<?php
namespace App\Controllers;

use App\Models\CartItems;
use Core\Cookie;
use Core\Controller;
use App\Models\Carts;
use Core\Lib\Utilities\Env;

/**
 * Undocumented class
 */
class CartController extends Controller {
    /**
     * Runs when the object is constructed.
     *
     * @return void
     */
    public function onConstruct(): void {
        $this->view->setLayout('default');
    }

    public function indexAction(): void {
        $this->view->render('cart/index');
    }

    public function addToCartAction($product_id) {
        $cart = Carts::findCurrentCartOrCreateNew($product_id);
        $item = CartItems::addProductToCart($cart->id, (int)$product_id);
        $item->qty = $item->qty + 1;
        $item->save();
        $this->view->render('cart/addToCart');
    }
}
