<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->unsignedBigInteger('survey_id');
            $table->foreign(['survey_id'])->on('surveys')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('votes')->default(0);
        });
    }

    /**
     * Reverse t$table->string('nome', 250);he migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
}
