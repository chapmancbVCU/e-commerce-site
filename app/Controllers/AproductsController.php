<?php
namespace App\Controllers;
use Core\Controller;

/**
 * Undocumented class
 */
class AproductsController extends Controller {
    /**
     * Runs when the object is constructed.
     *
     * @return void
     */
    public function onConstruct(): void{
        $this->view->setLayout('default');
    }
}
