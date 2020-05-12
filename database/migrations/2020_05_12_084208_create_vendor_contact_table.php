<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_contact', function (Blueprint $table) {
            $table->id();
            $table->string('account_name');
            $table->string('type_of_contact');
            $table->foreignId('vendor_id');
            $table->timestamps();
        });

        Schema::table('vendor_contact', function (Blueprint $column) {
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
        Schema::dropIfExists('vendor_contact');
    }
}
