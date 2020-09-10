<?php

use App\Models\Junior;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

class JuniorAddToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('juniors', function (Blueprint $table) {
            $table->string('token')->nullable();
        });

        foreach (Junior::all() as $junior) {
            $junior->token = Uuid::uuid4();
            $junior->save();
        }
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
