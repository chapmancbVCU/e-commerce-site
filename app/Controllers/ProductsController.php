<?php
namespace App\Controllers;
use Core\Router;
use Core\Session;
use Core\Controller;
use App\Models\Products;

/**
 * Undocumented class
 */
class ProductsController extends Controller {
    /**
     * Runs when the object is constructed.
     *
     * @return void
     */
    public function onConstruct(): void {
        $this->view->setLayout('default');
    }

    public function detailsAction($product_id) {
        $product = Products::findById((int)$product_id);

        if(!$product) {
            Session::addMessage('danger', 'This product does not exist');
            Router::redirect('home');
        }

        $options = $product->getOptions();
        $selectOptions = ['' => '- Choose an Option -'];
        foreach($options as $option) {
            $selectOptions[$option->id] = $option->name . ' ('.$option->inventory.' available)'; 
        }
        $this->view->selectOptions = $selectOptions;
        $this->view->images = $product->getImages();
        $this->view->product = $product;
        $this->view->render('products/details');
    }
}
