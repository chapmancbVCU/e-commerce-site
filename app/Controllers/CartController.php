<?php
namespace App\Controllers;

use Core\Cookie;
use Core\Router;
use Core\Session;
use Core\Controller;
use App\Models\Carts;
use App\Models\CartItems;
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
        $cart_id = Cookie::get(Env::get('CART_COOKIE_NAME'));
        $itemCount = 0;
        $subTotal = 0.00;
        $shippingTotal = 0.00;

        $items = Carts::findAllItemsByCartId((int)$cart_id);

        foreach($items as $item) {
            $itemCount += $item->qty;
            $shippingTotal += ($item->qty * $item->shipping);
            $subTotal += ($item->qty * $item->price);
        }

        $this->view->subTotal = number_format($subTotal, 2);
        $this->view->shippingTotal = number_format($shippingTotal, 2);
        $this->view->grandTotal = number_format($subTotal + $shippingTotal, 2);
        $this->view->itemCount = $itemCount;
        $this->view->items = $items;
        $this->view->render('cart/index');
    }

    public function addToCartAction($product_id) {
        $cart = Carts::findCurrentCartOrCreateNew($product_id);
        $item = CartItems::addProductToCart($cart->id, (int)$product_id);
        $item->qty = $item->qty + 1;
        $item->save();
        $this->view->render('cart/addToCart');
    }

    public function changeQtyAction($direction, $item_id) {
        $item = CartItems::findById((int)$item_id);
        if($direction == 'down') {
            $item->qty -= 1;
        } else {
            $item->qty += 1;
        }

        if($item->qty > 0) {
            $item->save();
        }
        Session::addMessage('info', 'Cart Updated');
        Router::redirect('cart');
    }

    public function removeItemAction($item_id) {
        $item = CartItems::findById((int)$item_id);
        $item->delete();
        Session::addMessage('info', 'Cart Updated');
        Router::redirect('cart');
    }
}
