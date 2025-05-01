<?php
namespace App\Controllers;
use Core\DB;
use Core\Controller;
use App\Models\Brands;
use App\Models\Products;

/**
 * Implements support for our Home controller.  Functions found in this class 
 * will support tasks related to the home page.
 */
class HomeController extends Controller {
    /** 
     * The default action for this controller.  It performs rendering of this 
     * site's home page.
     * 
     * @return void
     */
    public function indexAction(): void {
        // DB::getInstance()->query(
        //     "UPDATE users SET acl = json_insert(acl, '\$[#]', ?) WHERE id = ?",
        //     ['VendorAdmin', 1]
        // );

        $search = $this->request->get('search');
        $brand = $this->request->get('brand');
        $min_price = $this->request->get('min_price');
        $max_price = $this->request->get('max_price');
        $page = (!empty($this->request->get('page'))) ? $this->request->get('page') : 1;
        $offset = $page - 1;
        $limit = 4;
        $options = [
            'search'  => $search,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'brand' => $brand,
            'limit' => $limit,
            'offset' => $offset
        ];
        $results = Products::featuredProducts($options);
        $products = $results['results'];
        $total = $results['total'];
        $this->view->page = $page;
        $this->view->totalPages = ceil($total / $limit);
        $this->view->hasFilters = Products::hasFilters($options);
        $this->view->min_price = $min_price;
        $this->view->max_price = $max_price;
        $this->view->brand = $brand;
        $this->view->brandOptions = Brands::getOptionsForForm();
        $this->view->search = $search;
        $this->view->products = $products;
        $this->view->render('home/index');
    }
}