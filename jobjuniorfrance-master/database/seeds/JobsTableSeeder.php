<?php

use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->insert([
        	[
        	'title' => Str::random(10),
        	'company_name' => Str::random(10),
        	'company_email' => Str::random(10),
        	'job_description' => Str::random(500),
        	'type' => 1,
        	'city' => Str::random(10),
        	'token' => Str::random(100),
        	'created_at' => date("Y-m-d H:i:s"),
        	],
        	[
        	'title' => Str::random(10),
        	'company_name' => Str::random(10),
        	'company_email' => Str::random(10),
        	'job_description' => Str::random(500),
        	'type' => 1,
        	'city' => Str::random(10),
        	'token' => Str::random(100),
        	'created_at' => date("Y-m-d H:i:s"),
        	],
        	[
        	'title' => Str::random(10),
        	'company_name' => Str::random(10),
        	'company_email' => Str::random(10),
        	'job_description' => Str::random(500),
        	'type' => 1,
        	'city' => Str::random(10),
        	'token' => Str::random(100),
        	'created_at' => date("Y-m-d H:i:s"),
        	],
        	[
        	'title' => Str::random(10),
        	'company_name' => Str::random(10),
        	'company_email' => Str::random(10),
        	'job_description' => Str::random(500),
        	'type' => 1,
        	'city' => Str::random(10),
        	'token' => Str::random(100),
        	'created_at' => date("Y-m-d H:i:s"),
        	],
        	[
        	'title' => Str::random(10),
        	'company_name' => Str::random(10),
        	'company_email' => Str::random(10),
        	'job_description' => Str::random(500),
        	'type' => 1,
        	'city' => Str::random(10),
        	'token' => Str::random(100),
        	'created_at' => date("Y-m-d H:i:s"),
        	],
        ]);
    }
}
