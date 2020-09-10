<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->integer('status')->default(0);
            $table->string('password');
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->timestamps();
        });

        if (config('site.create_admin') === true) {
            User::create(['email' => config('site.admin_email'), 'password' => Hash::make(config('site.admin_password'))]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
