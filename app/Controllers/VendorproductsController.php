<?php
namespace App\Controllers;

use Core\Router;
use Core\Controller;
use App\Models\Users;
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
        $user = Users::currentUser();
        $product = new Products();

        $productImages = ProductImages::findByUserId($user->id);
        if($this->request->isPost()) {
            $this->request->csrfCheck();

            // Handle file upload.
            $uploads = Uploads::handleUpload(
                $_FILES['productImages'],
                ProductImages::class,
                ROOT . DS,
                "5mb",
                $user,
                'productImages',
                true
            );
            $product->assign($this->request->get(), Products::blackList);
            $product->save();
            if($user->validationPassed()) {
                if($uploads) {
                    ProductImages::uploadProductImage($user->id, $uploads);
                }
                ProductImages::updateSortByUserId($user->id, json_decode($_POST['images_sorted']));

                // Redirect
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
