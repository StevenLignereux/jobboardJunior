<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AtlerJobsAddReceiptUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->text('receipt_url')->nullable()->after('invoice_address');
            $table->integer('payment_success')->nullable()->after('receipt_url');
            $table->text('payment_message')->nullable()->after('payment_success');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('receipt_url');
            $table->dropColumn('payment_success');
            $table->dropColumn('payment_message');
        });
    }
}
