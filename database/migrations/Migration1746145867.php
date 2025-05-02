<?php
namespace Database\Migrations;
use Core\Lib\Database\Schema;
use Core\Lib\Database\Blueprint;
use Core\Lib\Database\Migration;

/**
 * Migration class for the products table.
 */
class Migration1746145867 extends Migration {
    /**
     * Performs a migration.
     *
     * @return void
     */
    public function up(): void {
        Schema::table('products', function (Blueprint $table) {
            $table->tinyInteger('has_options');
            $table->integer('inventory');
            $table->index('has_options');
            $table->index('inventory');
        });
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
