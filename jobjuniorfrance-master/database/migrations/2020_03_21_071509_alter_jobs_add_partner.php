<?php

use App\Models\Job;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterJobsAddPartner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('partner_id')->nullable();
            $table->string('partner_name')->nullable();
            $table->string('cpc')->nullable();
            $table->string('currency')->nullable();
            $table->string('status')->default(config('status.waiting'));
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('job_responsabilities');
            $table->dropColumn('job_requirements');
            $table->dropColumn('annual_salary');
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->dateTime('created_at')->change();
            $table->dateTime('updated_at')->change()->nullable();
        });

        foreach (Job::all() as $job) {
            $job->status = config('status.valid');
            $job->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('partner_id');
            $table->dropColumn('partner_name');
            $table->dropColumn('cpc');
            $table->dropColumn('currency');
            $table->dropColumn('status');
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->longText('job_responsabilities')->nullable();
            $table->longText('job_requirements')->nullable();
            $table->integer('annual_salary')->default(0);
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->date('created_at')->change();
            $table->date('updated_at')->change()->nullable();
        });
    }
}
