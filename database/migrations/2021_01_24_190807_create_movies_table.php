<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('year');
            $table->longText('description');
            $table->boolean('converted')->default(0);
            $table->string('runtime')->nullable();
            $table->float('rating')->nullable();
            $table->string('trailer')->nullable();
            $table->string('studio')->nullable();
            $table->string('director')->nullable();
            $table->string('mpaa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
