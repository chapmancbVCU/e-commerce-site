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
    protected static $_uploadPath = 'storage'.DS.'app'.DS.'private'.DS .'product_images'.DS.'product_';
    public $url;
    public $product_id;

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
     * Finds all product images for a product.
     *
     * @param int $product_id The id of the product whose product images we want to 
     * retrieve.
     * @return bool|array The associative array of product image records for a 
     * product.
     */
    public static function findByProductId($product_id) {
        return $images = self::find([
            'conditions' => 'product_id = ?',
            'bind' => ['product_id' => $product_id],
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

    public static function deleteImages($product_id, $unlink = false) {
        $images = self::find([
            'conditions' => 'product_id = ?',
            'bind' => [$product_id]
        ]);
        foreach($images as $image) {
            $image->delete();
        }
        if($unlink) {
            $dirName = ROOT.DS.self::$_uploadPath.$image->product_id;
            array_map('unlink', glob("$dirName/*.*"));
            rmdir($dirName);
            unlink($dirName.DS);
        }
    }
    
    /**
     * Deletes a product image by id.
     *
     * @param int $id The id of the image we want to delete.
     * @return bool Result of delete operation.  True if success, otherwise 
     * false.
     */
    public static function deleteById($id) {
        $image = self::findById($id);
        $sort = $image->sort;
        $afterImages = self::find([
            'conditions' => 'product_id = ? and sort > ?',
            'bind' => [$image->product_id, $sort]
        ]);
        foreach($afterImages as $af) {
            $af->sort = $af->sort - 1;
            $af->save();
        }
        unlink(ROOT.DS.self::$_uploadPath.$image->product_id.DS.$image->name);
        return $image->delete();
    }

    /**
     * Performs upload operation for a product image.
     *
     * @param int $product_id The id of the product that the upload operation 
     * is performed upon.
     * @param Uploads $uploads The instance of the Uploads class for this 
     * upload.
     * @return void
     */
    public static function uploadProductImage($product_id, $uploads) {
        $lastImage = self::findFirst([
            'conditions' => "product_id = ?",
            'bind' => [$product_id],
            'order' => 'sort DESC'
        ]);
        $lastSort = (!$lastImage) ? 0 : $lastImage->sort;
        $path = self::$_uploadPath.$product_id.DS;
        foreach($uploads->getFiles() as $file) {
            $uploadName = $uploads->generateUploadFilename($file['name']);
            $image = new self();
            $image->url = $path . $uploadName;
            $image->name = $uploadName;
            $image->product_id = $product_id;
            $image->sort = $lastSort;
            if($image->save()) {
                $uploads->upload($path, $uploadName, $file['tmp_name']);
                $lastSort++;
            }
        }
    }

    /**
     * Updates sort order by product id.
     *
     * @param int $product_id The id of the product whose product images we want 
     * to sort.
     * @param array $sortOrder An array containing sort values for a product 
     * image.
     * @return void
     */
    public static function updateSortByProductId($product_id, $sortOrder = []) {
        $images = self::findByProductId($product_id);
        $i = 0;
        foreach($images as $image) {
            $val = 'image_'.$image->id;
            $sort = (in_array($val,$sortOrder)) ? array_search($val, $sortOrder) : $i;
            $image->sort = $sort;
            $image->save();
            $i++;
        }
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
