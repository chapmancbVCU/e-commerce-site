<?php
namespace App\Models;
use Core\Model;

/**
 * Implements features of the ProductImages class.
 */
class ProductImages extends Model {

    // Fields you don't want saved on form submit
    // public const blackList = [];

    // Set to name of database table.
    protected static $_table = 'product_images';

    // Soft delete
    protected static $_softDelete = true;
    
    // Fields from your database

    protected static $allowedFileTypes = ['image/gif', 'image/jpeg', 'image/png'];
    public $deleted = 0;
    public $id;
    protected static $maxAllowedFileSize = 5242880;
    public $name;
    public $sort;
    protected static $_uploadPath = 'storage'.DS.'app'.DS.'private'.DS .'product_images'.DS.'user_';
    public $url;
    public $user_id;

    /**
     * Getter function for $allowedFileTypes array
     *
     * @return array $allowedFileTypes The array of allowed file types.
     */
    public static function getAllowedFileTypes() {
        return self::$allowedFileTypes;
    }

    /**
     * Getter function for $maxAllowedFileSize.
     *
     * @return int $maxAllowedFileSize The max file size for an individual 
     * file.
     */
    public static function getMaxAllowedFileSize() {
        return self::$maxAllowedFileSize;
    }

    /**
     * Finds all product images for a user.
     *
     * @param int $user_id The id of the user whose product images we want to 
     * retrieve.
     * @return bool|array The associative array of product image records for a 
     * user.
     */
    public static function findByUserId($user_id) {
        return $images = self::find([
            'conditions' => 'user_id = ?',
            'bind' => ['user_id' => $user_id],
            'order' => 'sort'
        ]);
    }

    public function afterDelete(): void {
        // Implement your function
    }

    public function afterSave(): void {
        // Implement your function
    }

    public function beforeDelete(): void {
        // Implement your function
    }

    public function beforeSave(): void {
        $this->timeStamps();
    }

    /**
     * Performs validation for the productImages model.
     *
     * @return void
     */
    public function validator(): void {
        // Implement your function
    }
}
