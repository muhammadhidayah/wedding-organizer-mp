<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_banner', function (Blueprint $table) {
            $table->id();
            $table->string('photo_banner');
            $table->foreignId('vendor_id');            
            $table->timestamps();
        });

        Schema::table('vendor_banner', function (Blueprint $table) {
            $table->foreign('vendor_id')
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
        Schema::dropIfExists('vendor_banner');
    }
}
