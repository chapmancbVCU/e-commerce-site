<?php
namespace App\Models;
use Core\Model;
use Core\Validators\{
    RequiredValidator as Required,
    UniqueValidator as Unique
};

/**
 * Implements features of the Brands class.
 */
class Brands extends Model {

    // Fields you don't want saved on form submit
    // public const blackList = [];

    // Set to name of database table.
    protected static $_table = 'brands';

    // Soft delete
    protected static $_softDelete = true;
    
    // Fields from your database
    public $id;
    public $name;
    public $deleted = 0;
    public $created_at;
    public $updated_at;
    public $user_id;

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

    public static function findByUserIdAndId($user_id, $id) {
        return self::findFirst([
            'conditions' => 'user_id = ? AND id = ?',
            'bind' => [$user_id, $id]
        ]);
    }
    /**
     * Performs validation for the Brands model.
     *
     * @return void
     */
    public function validator(): void {
        $this->runValidation(new Required($this, ['field' => 'name', 'message' => 'Brand name is required.']));
        // Enforce unique when brand has been deleted.
        $this->runValidation(new Unique($this, ['field' => ['name', 'deleted'], 'message' => 'That brand already exists.']));
    }
}
