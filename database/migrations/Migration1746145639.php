<?php
namespace Database\Migrations;
use Core\Lib\Database\Schema;
use Core\Lib\Database\Blueprint;
use Core\Lib\Database\Migration;

/**
 * Migration class for the product_option_refs table.
 */
class Migration1746145639 extends Migration {
    /**
     * Performs a migration.
     *
     * @return void
     */
    public function up(): void {
        Schema::create('product_option_refs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('product_id');
            $table->integer('option_id');
            $table->integer('inventory');
            $table->index('product_id');
            $table->index('option_id');
            $table->index('inventory');
        });
    }

    /**
     * Undo a migration task.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists('product_option_refs');
    }
}
