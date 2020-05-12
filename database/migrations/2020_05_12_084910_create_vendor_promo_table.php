<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorPromoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_promo', function (Blueprint $table) {
            $table->id();
            $table->string('title_promo');
            $table->integer('discount_promo');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('vendor_id');
            $table->timestamps();
        });

        Schema::table('vendor_promo', function (Blueprint $column) {
            $column->foreign('vendor_id')
                ->references('id')
                ->on('vendor')
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
        Schema::dropIfExists('vendor_promo');
    }
}
