<?php
namespace App\Controllers;
use Core\Controller;
use App\Models\Transactions;

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
        $this->view->setLayout('vendoradmin');
    }

    public function indexAction() {
        $this->view->render('vendordashboard/index');
    }

    public function getDailySalesAction() {
        $range = $this->request->get('range');
        $transactions = Transactions::getDailySales($range);
        $labels = [];
        $data = [];
        foreach($transactions as $tx) {
            $labels[] = $tx->created_at;
            $data[] = $tx->amount;
        }

        $resp = ['data' => $data, 'labels' => $labels];
        $this->jsonResponse($resp);
    }
}
