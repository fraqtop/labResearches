<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetNullableTypeIdAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('analyses', function (Blueprint $table) {
           $table->bigInteger('type_id')
               ->unsigned()
               ->nullable()
               ->change();
        });

        Schema::table('genes', function (Blueprint $table) {
            $table->bigInteger('analysis_id')
                ->unsigned()
                ->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('analyses', function (Blueprint $table) {
            $table->bigInteger('type_id')
                ->unsigned()
                ->change();
        });

        Schema::table('genes', function (Blueprint $table) {
            $table->bigInteger('analysis_id')
                ->unsigned()
                ->nullable()
                ->change();
        });
    }
}
