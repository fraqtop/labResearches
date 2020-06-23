<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGenotypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genotypes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->bigInteger('gene_id')->unsigned();
            $table->bigInteger('genotype_status_id')->unsigned();
            $table->timestamps();
            $table->foreign('gene_id')->references('id')->on('genes');
            $table->foreign('genotype_status_id')->references('id')->on('genotype_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genotypes');
    }
}
