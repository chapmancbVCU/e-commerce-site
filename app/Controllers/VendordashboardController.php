<?php
namespace App\Controllers;
use Core\Controller;

/**
 * Vendor dashboard controller
 */
class VendordashboardController extends Controller {
    /**
     * Runs when the object is constructed.
     *
     * @return void
     */
    public function onConstruct(): void{
        $this->view->setLayout('default');
    }
}
