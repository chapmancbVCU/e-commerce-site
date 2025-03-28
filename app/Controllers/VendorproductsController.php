<?php
namespace App\Controllers;
use Core\Controller;
use Core\Lib\Utilities\Env;

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
        $this->view->setLayout('vendoradmin');
    }

    public function indexAction() {
        $this->view->render('vendorproducts/index');
    }

    public function addAction() {
        $this->view->displayErrors = [];
        $this->view->postAction = Env::get('APP_DOMAIN', '/').'vendorProducts/add';
        $this->view->render('vendorproducts/add');
    }
}
