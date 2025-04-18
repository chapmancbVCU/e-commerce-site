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
        return $this->featured == "on";
    }

    public static function featuredProducts() {
        $dbDriver = DB::getInstance()->getPDO()->getAttribute(\PDO::ATTR_DRIVER_NAME);
        // Use ANY_VALUE in MySQL to avoid ONLY_FULL_GROUP_BY issues
        $urlColumn = $dbDriver === 'mysql' ? 'ANY_VALUE(pi.url)' : 'pi.url';
        $brandColumn = $dbDriver === 'mysql' ? 'ANY_VALUE(brands.name)' : 'brands.name';

        $conditions = [
            'columns' => "products.*, {$urlColumn} AS url, {$brandColumn} AS brand",
            'joins' => [
                ['product_images', 'products.id = pi.product_id', 'pi'],
                ['brands', 'products.brand_id = brands.id']
            ],
            'conditions' => 'products.featured = 1 AND products.deleted = 0 AND pi.sort = 0',
            'group' => 'products.id'
        ];

        return self::find($conditions);
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
