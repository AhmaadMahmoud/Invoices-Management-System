<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_attachments', function (Blueprint $table) {
                $table->unsignedBigInteger('id_invoice');
                $table->foreign('id_invoice')->references('id')->on('invoices')->onDelete('cascade');
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_attachments', function (Blueprint $table) {
            //
        });
    }
};
