<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('company_name');
            $table->string('company_email');
            $table->longText('job_description')->nullable();
            $table->longText('job_responsabilities')->nullable();
            $table->longText('job_requirements')->nullable();
            $table->longText('how_to_apply')->nullable();
            $table->string('invoice_address')->nullable();
            $table->string('link')->nullable();
            $table->text('tags')->nullable();
            $table->string('slug')->nullable();
            $table->integer('type');
            $table->integer('annual_salary');
            $table->string('city');
            $table->date('created_at');
            $table->date('updated_at')->nullable();
        });

        // Schema::create('tags', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('tag');
        //     $table->date('created_at');
        //     $table->date('updated_at')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('jobs');
    }
}
