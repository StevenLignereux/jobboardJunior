<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Job;

class CreateJobTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('job_id')->unsigned();
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->bigInteger('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->timestamps();
        });

        //     $collection = Job::all();

        //     $tags_job = $collection->groupBy('tags');
        //     if ($tags_job->count() > 0) {
        //         foreach ($tags_job as $tags => $job) {
        //             $tags = explode(';', $tags);
        //             $current = DB::table('tags')->whereIn('name', $tags)->pluck('id');
        //             $job->all()[0]->tags()->attach($current);
        //         }
        //         Schema::table('jobs', function (Blueprint $table) {
        //             $table->dropColumn('tags');
        //         });
        //     }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_tag');
    }
}
