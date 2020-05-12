<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_package', function (Blueprint $table) {
            $table->id();
            $table->string('title_package');
            $table->text('detail_package');
            $table->double('price_package');
            $table->foreignId('vendor_id');
            $table->timestamps();
        });

        Schema::table('vendor_package', function (Blueprint $table) {
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
        Schema::dropIfExists('vendor_package');
    }
}
