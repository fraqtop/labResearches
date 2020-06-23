<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGenotypeResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genotype_research', function (Blueprint $table) {
            $table->bigInteger('genotype_id')->unsigned();
            $table->bigInteger('research_id')->unsigned();
            $table->foreign('genotype_id')->references('id')->on('genotypes');
            $table->foreign('research_id')->references('id')->on('researches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genotype_research');
    }
}
