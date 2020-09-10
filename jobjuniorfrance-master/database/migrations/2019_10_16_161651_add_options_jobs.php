<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOptionsJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->boolean('is_highlight')->default(false)->after('city');
            $table->date('end_week_at')->after('is_highlight')->nullable();
            $table->date('end_month_at')->after('end_week_at')->nullable();
            $table->integer('price')->after('end_month_at')->nullable();
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
            $table->dropColumn('is_highlight');
            $table->dropColumn('end_week_at');
            $table->dropColumn('end_month_at');
            $table->dropColumn('price');
        });
    }
}
