<?php
namespace App\Controllers;
use Core\Router;
use Core\Session;
use Core\Controller;
use App\Models\Users;
use App\Models\Brands;

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
        
        $this->view->brands = Brands::find([
            'conditions' => 'user_id = ?',
            'bind' => [$this->user->id],
            'order' => 'name'
        ]);

        $this->view->render('adminbrands/index');
    }

    public function saveAction() {
        if($this->request->isPost()) {
            $brand_id = $this->request->get('brand_id');

            $this->request->csrfCheck();
            $brand = ($brand_id === 'new') ? new Brands() : Brands::findByUserIdAndId($this->user->id, $brand_id);
            if($brand) {
                $brand->user_id = $this->user->id;
                $brand->name = $this->request->get('name');
                
                try {
                    if ($brand->save()) {
                        $resp = ['success' => true, 'brand' => $brand->data()];
                    } else {
                        $resp = ['success' => false, 'errors' => $brand->getErrorMessages()];
                    }
                } catch (\Throwable $e) {
                    $resp = ['success' => false, 'errors' => [$e->getMessage()]];
                }
            }
            $this->jsonResponse($resp);
        }
    }

    public function deleteAction(): void {
        if ($this->request->isPost()) {
            $this->request->csrfCheck();
    
            $id = $this->request->get('id');
            $brand = Brands::findByUserIdAndId($this->user->id, $id);
    
            if ($brand) {
                $brand->delete();
                Session::addMessage('success', "{$brand->name} was successfully deleted");
            } else {
                Session::addMessage('warning', "Something went wrong");
            }
        }
        Router::redirect('adminbrands/index');
    }

    public function getBrandByIdAction() {
        $resp = ['success' => false];

        if ($this->request->isPost()) {   
            // $this->request->csrfCheck();
            $id = $this->request->get('id');
            if($this->user) {
                $brand = Brands::findByUserIdAndId($this->user->id, $id);
            }
            
            if ($brand) {
                $brand->save();
                $resp['success'] = true;
                $resp['brand'] = $brand->data();
            }
        }
        $this->jsonResponse($resp);
    }
}
