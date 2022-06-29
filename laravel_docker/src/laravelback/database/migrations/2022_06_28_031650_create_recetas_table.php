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
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('ingredientes', 2000);
            $table->timestamps();
        });

        DB::table('recetas')->insert(
            array(
                'nombre' => 'receta1',
                'ingredientes' => '{"tomato": 1, "lemon": 2, "lettuce": 1, "chicken": 1}'
            ),
        );
        DB::table('recetas')->insert(
            array(
            'nombre' => 'receta2',
            'ingredientes' => '{"potato": 3, "cheese": 2, "rice": 1, "ketchup": 1}'
            ),
        );
        DB::table('recetas')->insert(
            array(
            'nombre' => 'receta3',
            'ingredientes' => '{"potato": 1, "cheese": 1, "onion": 1, "ketchup": 1, "meat": 2}'
            ),
        );
        DB::table('recetas')->insert(
            array(
            'nombre' => 'receta4',
            'ingredientes' => '{"tomato": 5, "lemon": 5, "potato": 5, "rice": 5, "ketchup": 5, "lettuce": 5, "onion": 5, "cheese": 5, "meat": 5, "chicken": 5}'
            ),
        );
        DB::table('recetas')->insert(
            array(
            'nombre' => 'receta3',
            'ingredientes' => '{"meat": 1, "cheese": 1, "onion": 1, "ketchup": 1}'
            ),
        );
        DB::table('recetas')->insert(
            array(
            'nombre' => 'receta3',
            'ingredientes' => '{"meat": 1, "cheese": 1, "onion": 1, "ketchup": 1, "chicken": 1}'
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
        Schema::dropIfExists('recetas');
    }
};
