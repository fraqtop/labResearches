<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRelationsGenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('genes', function (Blueprint $table) {
            $table->addColumn('bigInteger', 'analysis_id')->unsigned();
            $table->foreign('analysis_id')
                ->references('id')
                ->on('analyses')
                ->onDelete('cascade');
        });
        Schema::table('genotypes', function (Blueprint $table) {
            $table->dropForeign('genotypes_gene_id_foreign');
            $table->foreign('gene_id')
                ->references('id')
                ->on('genes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('genes', function (Blueprint $table) {
            $table->dropForeign('genes_analysis_id_foreign');
            $table->dropColumn('analysis_id');
        });
        Schema::table('genotypes', function (Blueprint $table) {
            $table->dropForeign('genotypes_gene_id_foreign');
            $table->foreign('gene_id')
                ->references('id')
                ->on('genes');
        });
    }
}
