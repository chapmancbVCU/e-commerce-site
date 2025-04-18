<?php
namespace Database\Migrations;
use Core\Lib\Database\Schema;
use Core\Lib\Database\Blueprint;
use Core\Lib\Database\Migration;

/**
 * Migration class for the transactions table.
 */
class Migration1744933026 extends Migration {
    /**
     * Performs a migration.
     *
     * @return void
     */
    public function up(): void {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('cart_id');
            $table->string('gateway', 15);
            $table->string('type', 25);
            $table->decimal('amount', 10, 2);
            $table->string('charge_id', 255);
            $table->tinyInteger('success');
            $table->string('reason', 155)->nullable();
            $table->string('card_brand', 25);
            $table->string('last4', 4);
            $table->string('name', 255);
            $table->string('shipping_address1', 255);
            $table->string('shipping_address2', 255);
            $table->string('shipping_city', 155);
            $table->string('shipping_state', 155);
            $table->string('shipping_zip', 55);
            $table->string('shipping_country', 15);
            $table->softDeletes();
            $table->index('cart_id');
            $table->index('success');
        });
    }

    /**
     * Undo a migration task.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists('transactions');
    }
}
