<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredientes', function (Blueprint $table) {
            $table->id();
            $table->string('json', 2000);
            $table->timestamps();
        });

        DB::table('ingredientes')->insert(
            array(
                'json' => '{"tomato": 5, "lemon": 5, "potato": 5, "rice": 5, "ketchup": 5, "lettuce": 5, "onion": 5, "cheese": 5, "meat": 5, "chicken": 5}',
            ),
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredientes');
    }
};
