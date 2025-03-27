<?php
namespace App\Controllers;
use Core\Controller;

/**
 * Vendor products controller
 */
class VendorproductsController extends Controller {
    /**
     * Runs when the object is constructed.
     *
     * @return void
     */
    public function onConstruct(): void{
        $this->view->setLayout('default');
    }

    public function indexAction() {
        $this->view->render('vendorproducts/index');
    }
}
