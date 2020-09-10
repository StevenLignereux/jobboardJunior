<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
}
