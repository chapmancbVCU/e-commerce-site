<?php
namespace Database\Migrations;
use Core\Lib\Database\Schema;
use Core\Lib\Database\Blueprint;
use Core\Lib\Database\Migration;

/**
 * Migration class for the cart_items table.
 */
class Migration1746146132 extends Migration {
    /**
     * Performs a migration.
     *
     * @return void
     */
    public function up(): void {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->integer('option_id');
            $table->index('option_id');
        });
    }

    /**
     * Undo a migration task.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists('cart_items');
    }
}
