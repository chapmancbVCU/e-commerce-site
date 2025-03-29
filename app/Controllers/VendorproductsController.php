<?php
namespace App\Controllers;
use Core\Router;
use Core\Controller;
use App\Models\Products;
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
        $product = new Products();

        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $product->assign($this->request->get(), Products::blackList);
            if($product->save()) {
                Router::redirect('vendorproducts/index');
            }
        }

        // Configure the view.
        $this->view->product = $product;
        $this->view->displayErrors = $product->getErrorMessages();
        $this->view->postAction = Env::get('APP_DOMAIN', '/').'vendorproducts/add';
        $this->view->render('vendorproducts/add');
    }
}
