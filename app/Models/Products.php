<?php
namespace App\Models;
use Core\Model;
use Core\Validators\{
    RequiredValidator as Required,
    NumericValidator as Numeric
};
use Core\Lib\Utilities\Arr;

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
        $conditions = [
            'columns' => 'products.*, pi.url AS url, brands.name AS brand',
            'joins' => [
                ['product_images', 'products.id = pi.product_id', 'pi'],
                ['brands', 'products.brand_id = brands.id']
            ],
            'conditions' => 'products.featured = 1 AND products.deleted = 0 AND pi.sort = 0',
            'group' => 'pi.product_id'
        ];
        return self::find($conditions);

        // $sql = "SELECT products.*, pi.url as url, brands.name as brand
        // FROM products
        // JOIN product_images as pi
        // ON products.id = pi.product_id
        // JOIN brands
        // ON products.brand_id = brands.id
        // WHERE products.featured = '1' and products.deleted = '0' and pi.sort = '0'
        // group by pi.product_id
        // ";
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
