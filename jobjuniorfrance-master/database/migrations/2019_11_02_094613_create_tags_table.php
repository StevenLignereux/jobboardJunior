<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });


        DB::table('tags')->insert([
            ['name' => 'Angular'],
            ['name' => 'BackEnd'],
            ['name' => 'Bash'],
            ['name' => 'Bootstrap'],
            ['name' => 'Css3'],
            ['name' => 'CssFrameworks'],
            ['name' => 'Debian'],
            ['name' => 'Django'],
            ['name' => 'Docker'],
            ['name' => 'Flask'],
            ['name' => 'FrontEnd'],
            ['name' => 'FullStack'],
            ['name' => 'Html5'],
            ['name' => 'Ionic'],
            ['name' => 'Java'],
            ['name' => 'Javascript'],
            ['name' => 'JQuery'],
            ['name' => 'Kafka'],
            ['name' => 'Laravel'],
            ['name' => 'MongoDB'],
            ['name' => 'Nodejs'],
            ['name' => 'NoSQL'],
            ['name' => 'Php'],
            ['name' => 'Python'],
            ['name' => 'RabbitMq'],
            ['name' => 'Reactjs'],
            ['name' => 'SQL'],
            ['name' => 'Symfony'],
            ['name' => 'Vuejs'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
