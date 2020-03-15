<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('days');
            $table->timestamps();
        });
        $researches = [
            ['title' => 'Исследование 1', 'days' => 2],
            ['title' => 'Исследование 2', 'days' => 3],
            ['title' => 'Долгое исследование', 'days' => 5],
            ['title' => 'Быстрое исследование', 'days' => 1],
            ['title' => 'Исследование 5', 'days' => 2]
        ];
        \App\Research::insert($researches);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('researches');
    }
}
