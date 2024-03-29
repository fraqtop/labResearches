<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->id();
            $table->string('inner_number')->nullable();
            $table->date('material_taken_at')->nullable();
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('initiator_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('diagnosis')->nullable();
            $table->bigInteger('material_id')->unsigned()->nullable();
            $table->bigInteger('analysis_id')->unsigned();
            $table->bigInteger('pay_type_id')->unsigned();
            $table->date('issue_planed_at');
            $table->date('issued_at')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('researches');
    }
}
