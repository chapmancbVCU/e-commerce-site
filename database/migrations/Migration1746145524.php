<?php
namespace Database\Migrations;
use Core\Lib\Database\Schema;
use Core\Lib\Database\Blueprint;
use Core\Lib\Database\Migration;

/**
 * Migration class for the options table.
 */
class Migration1746145524 extends Migration {
    /**
     * Performs a migration.
     *
     * @return void
     */
    public function up(): void {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('name', 155);
            $table->softDeletes();
        });
    }

    /**
     * Undo a migration task.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists('options');
    }
}
