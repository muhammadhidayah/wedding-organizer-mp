<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapPromoPackageVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_promo_package_vendor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promo_id');
            $table->foreignId('package_id');
            $table->timestamps();
        });

        Schema::table('map_promo_package_vendor', function (Blueprint $column) {
            $column ->foreign('promo_id')
                    ->references('id')
                    ->on('vendor_promo')
                    ->onDelete('cascade');

            $column ->foreign('package_id')
                    ->references('id')
                    ->on('vendor_package')
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
        Schema::dropIfExists('map_promo_package_vendor');
    }
}
