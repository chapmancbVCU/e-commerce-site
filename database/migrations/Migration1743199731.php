<?php
namespace Database\Migrations;
use Core\Lib\Database\Schema;
use Core\Lib\Database\Blueprint;
use Core\Lib\Database\Migration;

/**
 * Migration class for the products table.
 */
class Migration1743199731 extends Migration {
    /**
     * Performs a migration.
     *
     * @return void
     */
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 155);
            $table->decimal('price', 10, 2);
            $table->decimal('list', 10, 2);
            $table->decimal('shipping', 10, 2);
            $table->text('description');
            $table->softDeletes();
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
