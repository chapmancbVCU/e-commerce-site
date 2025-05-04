<?php
namespace App\Models;
use Core\{DB, Model};
use Core\Validators\{
    RequiredValidator as Required,
    UniqueValidator as Unique
};

/**
 * Implements features of the Options class.
 */
class Options extends Model {

    // Fields you don't want saved on form submit
    // public const blackList = [];

    // Set to name of database table.
    protected static $_table = 'options';

    // Soft delete
    protected static $_softDelete = true;
    
    // Fields from your database
    public $id;
    public $name;
    public $deleted = 0;

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
        // Implement your function
    }

    public static function getOptionsByProductId($id) {
        if($id == 'new') return [];
        $sql = "SELECT options.*, refs.inventory 
            FROM options
            JOIN product_option_refs as refs ON options.id = refs.option_id
            WHERE refs.product_id = ?
        ";

        return DB::getInstance()->query($sql, [$id])->results();
    }

    /**
     * Performs validation for the Options model.
     *
     * @return void
     */
    public function validator(): void {
        $this->runValidation(new Required($this, ['field' => 'name', 'message' => 'Option Name is required']));
        $this->runValidation(new Unique($this, ['field' => ['name', 'deleted'], 'message' => 'That option already exists']));
    }
}
