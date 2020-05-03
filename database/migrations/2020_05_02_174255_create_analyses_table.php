<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analyses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique('idx_analyses_code');
            $table->text('description');
            $table->decimal('price');
            $table->integer('duration');
            $table->string('executor')->nullable();
            $table->unsignedBigInteger('type_id');
            $table->timestamps();
            $table->foreign('type_id')->references('id')->on('analysis_types');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analyses');
    }
}
