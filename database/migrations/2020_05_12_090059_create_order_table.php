<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('inv_number');
            $table->foreignId('user_id');
            $table->foreignId('package_id');
            $table->foreignId('promo_id')->nullable();
            $table->date('wedding_date');
            $table->enum('payment_status', ['unpaid','confirmation', 'paid'])->default('unpaid');
            $table->double('total_price');
            $table->timestamps();
        });

        Schema::table('order', function (Blueprint $column) {
            $column ->foreign('promo_id')
                    ->references('id')
                    ->on('vendor_promo')
                    ->onDelete('cascade');

            $column ->foreign('package_id')
                    ->references('id')
                    ->on('vendor_package')
                    ->onDelete('cascade');
            
            $column ->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
