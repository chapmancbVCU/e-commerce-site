<?php
namespace App\Controllers;

use Core\Router;
use Core\Session;
use Core\Controller;
use App\Models\Users;
use App\Models\Products;
use Core\Lib\Utilities\Env;
use Core\Lib\Utilities\Str;
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
        $this->user = Users::currentUser();
    }

    public function indexAction() {
        $this->view->products = Products::findByUserId($this->user->id);
        $this->view->render('vendorproducts/index');
    }

    public function addAction() {
        $product = new Products();
        
        if($this->request->isPost()) {
            $this->request->csrfCheck();

            if(Str::isEmpty($_FILES['productImages']['tmp_name'][0])) {
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
            $product->user_id = $this->user->id;
            $product->save();
            if($product->validationPassed()) {
                if($uploads) {
                    ProductImages::uploadProductImage($product->id, $uploads);
                    Session::addMessage('success', "Product added!");
                }
                Router::redirect('vendorproducts/index');
            }
        }

        // Configure the view.
        $this->view->displayErrors = $product->getErrorMessages();
        $this->view->postAction = Env::get('APP_DOMAIN', '/').'vendorproducts/add';
        $this->view->render('vendorproducts/add');
    }

    public function deleteAction() {
        $resp = ['success' => false, 'msg' => 'Something went wrong...'];
        if($this->request->isPost()) {
            $id = $this->request->get('id');
            $product = Products::findByIdAndUserId($id, $this->user->id);
            if($product) {
                // $product->delete();
                $resp = ['success' => true, 'msg' => 'Product Deleted.'];
            }
        }
        $this->jsonResponse($resp);
    }
}
