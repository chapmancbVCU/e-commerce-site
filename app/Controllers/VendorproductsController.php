<?php
namespace App\Controllers;

use Core\Router;
use Core\Session;
use Core\Controller;
use App\Models\Users;
use App\Models\Brands;
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
            $product->assign($this->request->get(), Products::blackList);
            $product->featured = ($this->request->get('featured') == 'on') ? 1 : 0;
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
        $this->view->product = $product;
        $this->view->brands = Brands::getOptionsForForm($this->user->id);
        $this->view->displayErrors = $product->getErrorMessages();
        $this->view->postAction = Env::get('APP_DOMAIN', '/').'vendorproducts/add';
        $this->view->render('vendorproducts/add');
    }

    public function editAction($id) {
        $product = Products::findByIdAndUserId((int)$id, (int)$this->user->id);

        if(!$product) {
            Session::addMessage('danger', 'You do not have permission to edit that product.');
            Router::redirect('vendorproducts/index');
        }

        $productImages = ProductImages::findByProductId($product->id);
        if($this->request->isPost()) {
            $this->request->csrfCheck();

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

            $product->assign($this->request->get(), Products::blackList);
            $product->featured = ($this->request->get('featured') == 'on') ? 1 : 0;
            $product->user_id = $this->user->id;
            $product->save();

            if($product->validationPassed()) {
                if($uploads) {
                    ProductImages::uploadProductImage($product->id, $uploads);
                    Session::addMessage('success', "Product updated!");
                }
                ProductImages::updateSortByProductId($product->id,  json_decode($_POST['images_sorted']));
                Router::redirect('vendorproducts/index');
            }
        }

        $this->view->brands = Brands::getOptionsForForm($this->user->id);
        $this->view->productImages = $productImages;
        $this->view->product = $product;
        $this->view->displayErrors = $product->getErrorMessages();
        $this->view->render('vendorproducts/edit');
    }

    public function deleteAction() {
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $id = $this->request->get('id');
            $product = Products::findByIdAndUserId($id, $this->user->id);
            if($product) {
                ProductImages::deleteImages($id, false);
                $product->delete();
                Session::addMessage('success', 'Product deleted');
            }
        }
        Router::redirect('vendorproducts/index');
    }

    public function toggleFeaturedAction(): void {
        if($this->request->isPost()) {
            $this->request->csrfCheck();

            $id = $this->request->get('id');
            $product = Products::findByIdAndUserId($id, $this->user->id);

            if($product) {
                $product->featured = ($product->featured == 1)? 0 : 1;
                Session::addMessage('success', ($product->featured ==1)? "{$product->name} is now featured." : "{$product->name} is no longer featured.");
                $product->save();
            }
        }

        Router::redirect('vendorproducts/index');
    }

    /**
     * Deletes an image associated with a user's profile.
     *
     * @return void
     */
    function deleteImageAction(): void {
        $resp = ['success' => false];
        if($this->request->isPost()) {
            $user = Users::currentUser();
            $id = $this->request->get('image_id');
            $image = ProductImages::findById($id);
            if($user) {
                ProductImages::deleteById($image->id);
                $resp = ['success' => true, 'model_id' => $image->id];
            }
        }
        $this->jsonResponse($resp);
    }
}
