<?php
namespace App\Models;
use Core\Model;

/**
 * Implements features of the ProductOptionRefs class.
 */
class ProductOptionRefs extends Model {

    // Fields you don't want saved on form submit
    // public const blackList = [];

    // Set to name of database table.
    protected static $_table = 'product_option_refs';

    // Soft delete
    // protected static $_softDelete = true;
    
    // Fields from your database
    public $id;
    public $created_at;
    public $updated_at;
    public $option_id;
    public $inventory = 0;

    public function afterDelete(): void {
        // Implement your function
    }

    public function afterSave(): void {
        // Implement your function
    }

    public function beforeDelete(): void {
        $this->timeStamps();
    }

    public function beforeSave(): void {
        $this->timeStamps();
    }

    public static function findOrCreate($product_id, $option_id) {
        $ref = self::findByProductId($product_id, $option_id);
        if(!$ref) {
            $ref = new self();
            $ref->product_id = (int)$product_id;
            $ref->option_id = (int)$option_id;
        }
        return $ref;
    }

    public static function findByProductId($product_id, $option_id) {
        return self::findFirst([
            'conditions' => 'product_id = ? AND option_id = ?',
            'bind' => [$product_id, $option_id]
        ]);
    }

    /**
     * Performs validation for the ProductOptionRefs model.
     *
     * @return void
     */
    public function validator(): void {
        // Implement your function
    }
}
