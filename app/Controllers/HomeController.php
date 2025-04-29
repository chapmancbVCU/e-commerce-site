<?php
namespace App\Controllers;
use Core\Controller;
use App\Models\Products;
use Core\DB;

/**
 * Implements support for our Home controller.  Functions found in this class 
 * will support tasks related to the home page.
 */
class HomeController extends Controller {
    /** 
     * The default action for this controller.  It performs rendering of this 
     * site's home page.
     * 
     * @return void
     */
    public function indexAction(): void {
        // DB::getInstance()->query(
        //     "UPDATE users SET acl = json_insert(acl, '\$[#]', ?) WHERE id = ?",
        //     ['VendorAdmin', 1]
        // );
        $products = Products::featuredProducts();

        $this->view->min_price = '';
        $this->view->max_price = '';
        $this->view->brand = '';
        $this->view->brandOptions = [];
        $this->view->search = '';
        $this->view->products = $products;
        $this->view->render('home/index');
    }
}