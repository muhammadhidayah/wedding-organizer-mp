<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeginKeyToVendorBankAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_bank_account', function (Blueprint $table) {
            //
            Schema::table("vendor_bank_account", function(Blueprint $column) {
                $column ->foreign('bank_id')
                        ->references('id')
                        ->on('list_bank')
                        ->onDelete('cascade');
    
                $column ->foreign('vendor_id')
                        ->references('id')
                        ->on('vendor')
                        ->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_bank_account', function (Blueprint $table) {
            //
        });
    }
}
