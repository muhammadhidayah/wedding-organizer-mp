<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorCollectionPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_collection_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_photo_id');
            $table->string('photo');
            $table->timestamps();
        });

        Schema::table('vendor_collection_photos', function (Blueprint $table) {
            $table->foreign('vendor_photo_id')
                ->references('id')
                ->on('vendor_photos')
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
        Schema::dropIfExists('vendor_collection_photos');
    }
}
