<?php
namespace App\Controllers;
use Core\Controller;
use App\Models\Products;
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
        $products = Products::featuredProducts();
        $this->view->products = $products;
        $this->view->render('home/index');
    }
}