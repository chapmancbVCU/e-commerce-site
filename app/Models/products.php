<?php
namespace App\Models;
use Core\Model;
use Core\Lib\Utilities\Str;


/**
 * 
 */
class Products extends Model {

    // Fields you don't want saved on form submit
    // public const blackList = [];

    // Set to name of database table.
    protected static $_table = 'products';

    // Soft delete
    // protected static $_softDelete = true;
    
    // Fields from your database

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
        //
    }

    /**
     * Performs validation for the products model.
     *
     * @return void
     */
    public function validator(): void {
        //
    }
}
