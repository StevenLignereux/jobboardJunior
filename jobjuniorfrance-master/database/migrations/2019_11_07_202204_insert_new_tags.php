<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertNewTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('tags')->insert(
            [
                ['name' => 'Ajax'],
                ['name' => 'Rest'],
                ['name' => 'Soap'],
                ['name' => 'Git'],
                ['name' => 'Kubernetes'],
                ['name' => 'JEE'],
                ['name' => 'Hibernate']
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
