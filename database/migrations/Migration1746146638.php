<?php
namespace Database\Migrations;
use Core\DB;
use Core\Lib\Database\Schema;
use Core\Lib\Database\Blueprint;
use Core\Lib\Database\Migration;

/**
 * Migration class for the products table.
 */
class Migration1746146638 extends Migration {
    /**
     * Performs a migration.
     *
     * @return void
     */
    public function up(): void {
        $sql = "UPDATE products SET `has_options` = 0, `inventory` = 0";
        DB::getInstance()->query($sql);
    }

    /**
     * Undo a migration task.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists('products');
    }
}
