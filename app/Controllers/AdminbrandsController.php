<?php
namespace App\Controllers;
use Core\Controller;
use App\Models\Users;
use App\Models\Brands;
use Core\Router;

/**
 * Undocumented class
 */
class AdminbrandsController extends Controller {
    /**
     * Runs when the object is constructed.
     *
     * @return void
     */
    public function onConstruct(): void {
        $this->view->setLayout('vendoradmin');
        $this->user = Users::currentUser();
    }

    public function indexAction() {
        $brand = new Brands();

        $this->view->brand = $brand;
        $this->view->formErrors = $brand->getErrorMessages();
        $this->view->brands = Brands::find(['order' => 'name']);
        $this->view->render('adminbrands/index');
    }

    public function saveAction() {
        if($this->request->isPost()) {
            $this->request->csrfCheck();
            $brand = new Brands();
            $brand->name = $this->request->get('name');
            if($brand->save()) {
                $resp = ['success' => true, 'brand' => $brand->data()];
            } else {
                $resp = ['success' => false, 'errors' => $brand->getErrorMessages()];
            }
            $this->jsonResponse($resp);
        }
    }

    public function deleteAction(): void {
        if ($this->request->isPost()) {
            $this->request->csrfCheck();
    
            $id = $this->request->get('id');
            $brand = Brands::findById($id);
    
            if ($brand) {
                $brand->delete();
            }
        }
        Router::redirect('adminbrands/index');
    }
}
