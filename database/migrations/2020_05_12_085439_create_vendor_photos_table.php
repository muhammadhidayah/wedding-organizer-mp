<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_photos', function (Blueprint $table) {
            $table->id();
            $table->string('title_photo');
            $table->foreignId('vendor_id');
            $table->timestamps();
        });

        Schema::table('vendor_photos', function (Blueprint $table) {
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
        Schema::dropIfExists('vendor_photos');
    }
}
