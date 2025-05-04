<?php
namespace App\Models;
use Core\Model;
use Core\Validators\{
    RequiredValidator as Required,
    NumericValidator as Numeric
};
use Core\Lib\Utilities\Arr;
use Core\DB;

/**
 * Implements features of the Products class.
 */
class Products extends Model {

    // Fields you don't want saved on form submit
    public const blackList = ['id', 'deleted', 'featured'];

    // Set to name of database table.
    protected static $_table = 'products';

    // Soft delete
    protected static $_softDelete = true;
    
    // Fields from your database
    public $id;
    public $created_at;
    public $updated_at;
    public $name;
    public $price;
    public $list;
    public $shipping;
    public $deleted = 0;
    public $description;
    public $user_id;
    public $featured = 0;
    public $brand_id = 0;
    public $has_options = 0;
    public $inventory = 0;

    public function afterDelete(): void {
        //
    }

    public function afterSave(): void {
        //
    }

    public function beforeDelete(): void {
        //
    }

    public function beforeSave(): void {
        $this->timeStamps();
    }

    public static function findByUserId($user_id, $params = []) {
        $conditions = [
            'conditions' => 'user_id = ?',
            'bind' => [(int)$user_id],
            'order' => 'name'
        ];
        $params = Arr::merge($conditions, $params);
        return self::find($params);
    }

    public static function findByIdAndUserId($id, $user_id) {
        $conditions = [
            'conditions' => 'id = ? AND  user_id = ?',
            'bind' => [(int)$id, (int)$user_id]
        ];
        return self::findFirst($conditions);
    }

    public function isChecked() {
        return $this->featured === 1;
    }

    public function hasOptions() {
        return $this->has_options === 1;
    }

    public function getOptions() {
        if(!$this->hasOptions()) return [];
        $sql = "SELECT options.id, options.name, refs.inventory
            FROM options
            JOIN product_option_refs as refs ON options.id = refs.option_id
            WHERE refs.product_id = ? AND refs.inventory > 0
        ";

        return DB::getInstance()->query($sql, [$this->id])->results();
    }

    public static function featuredProducts($options) {
        $db = DB::getInstance();
        $limit = (Arr::exists($options, 'limit') && !empty($options['limit'])) ? $options['limit'] : 4;
        $offset = (Arr::exists($options, 'offset') && !empty($options['offset'])) ? $options['offset'] : 0;
        $where = "products.deleted = 0 AND pi.sort = '0' AND pi.deleted = 0 AND products.inventory > 0";
        $hasFilters = self::hasFilters($options);
    
        $binds = [];
        if(Arr::exists($options, 'brand') && !empty($options['brand'])) {
            $where .= " AND brands.id = ?";
            $binds[] = $options['brand'];
        }
    
        if(Arr::exists($options, 'min_price') && !empty($options['min_price'])) {
            $where .= " AND products.price >= ?";
            $binds[] = $options['min_price'];
        }
    
        if(Arr::exists($options, 'max_price') && !empty($options['max_price'])) {
            $where .= " AND products.price <= ?";
            $binds[] = $options['max_price'];
        }
    
        if(Arr::exists($options, 'search') && !empty($options['search'])) {
            $where .= " AND (products.name LIKE ? OR brands.name LIKE ?)";
            $binds[] = "%" . $options['search'] . "%";
            $binds[] = "%" . $options['search'] . "%";
        }
    
        $dbDriver = DB::getInstance()->getPDO()->getAttribute(\PDO::ATTR_DRIVER_NAME);
        $urlColumn = ($dbDriver === 'mysql' || $dbDriver === 'mariadb') ? 'ANY_VALUE(pi.url)' : 'pi.url';
        $brandColumn = ($dbDriver === 'mysql' || $dbDriver === 'mariadb') ? 'ANY_VALUE(brands.name)' : 'brands.name';
    
        $sql = "SELECT products.*, {$urlColumn} as url, {$brandColumn} as brand
            FROM products
            JOIN product_images as pi ON products.id = pi.product_id
            JOIN brands ON products.brand_id = brands.id
            WHERE {$where}";
    
        $group = ($hasFilters)
            ? " GROUP BY products.id ORDER BY products.name"
            : " GROUP BY products.id ORDER BY products.featured DESC";
    
        // ✅ Don't use LIMIT/OFFSET binds for total
        $total = $db->query($sql . $group, $binds)->count();
    
        // ✅ Add LIMIT/OFFSET binds only for results
        $pager = " LIMIT ? OFFSET ?";
        $resultBinds = array_merge($binds, [$limit, $offset]);
        $results = $db->query($sql . $group . $pager, $resultBinds)->results();
    
        return ['results' => $results, 'total' => $total];
    }
    
    
    public static function hasFilters($options) {
        foreach($options as $key => $value) {
            if(!empty($value) && $key != 'limit' && $key != 'offset') return true;
        }
        return false;
    }

    public function getBrandName() {
        if(empty($this->brand_id)) return "";

        $brand = Brands::findFirst([
            'conditions' => 'id = ?',
            'bind' => [$this->brand_id]
        ]);

        return ($brand) ? $brand->name : "";
    }

    public function displayShipping() {
        return ($this->shipping == '0.00') ? "Free Shipping" : "$" . $this->shipping;
    }

    public function getImages() {
        return ProductImages::find([
            'conditions' => 'product_id = ?',
            'bind' => [$this->id],
            'order' => 'sort'
        ]);
    }

    /**
     * Performs validation for the products model.
     *
     * @return void
     */
    public function validator(): void {
        $requiredFields =  ['name' => "Name", 'price' => 'Price', 'list' => 'List Price', 'shipping' => 'Shipping', 'description' => 'Description'];
        foreach($requiredFields as $field => $display) {
            $this->runValidation(new Required($this,['field'=>$field,'message'=>$display." is required."]));
        }
        $this->runValidation(new Numeric($this, ['field' => 'price', 'message' => 'Price must be a number']));
        $this->runValidation(new Numeric($this, ['field' => 'list', 'message' => 'List Price must be a number']));
        $this->runValidation(new Numeric($this, ['field' => 'shipping', 'message' => 'Shipping must be a number']));
    }
}
