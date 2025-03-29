<?php
namespace App\Controllers;

use Core\Router;
use Core\Controller;
use App\Models\Products;
use Core\Lib\Utilities\Env;
use App\Models\ProductImages;
use Core\Lib\FileSystem\Uploads;

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

            if(empty($_FILES['productImages']['tmp_name'][0])) {
                $product->addErrorMessage('productImages', 'You must choose an image');
            }
            // Handle file upload.
            $uploads = Uploads::handleUpload(
                $_FILES['productImages'],
                ProductImages::class,
                ROOT . DS,
                "5mb",
                $product,
                'productImages',
                Uploads::MULTIPLE
            );
            $product->assign($this->request->get());
            $product->save();
            if($product->validationPassed()) {
                if($uploads) {
                    ProductImages::uploadProductImage($product->id, $uploads);
                }
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
