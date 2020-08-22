<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExecutorIdToResearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('researches', function (Blueprint $table) {
            $table->date('registered_at')->after('inner_number');
            $table->bigInteger('executor_id')->after('patient_id')->unsigned();
            $table->foreign('executor_id')->references('id')->on('institutions');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('initiator_id')->references('id')->on('institutions');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('material_id')->references('id')->on('material_types');
            $table->foreign('analysis_id')->references('id')->on('analyses');
            $table->foreign('pay_type_id')->references('id')->on('pay_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('researches', function (Blueprint $table) {
            $table->dropForeign(['executor_id']);
            $table->dropForeign(['patient_id']);
            $table->dropForeign(['initiator_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['material_id']);
            $table->dropForeign(['analysis_id']);
            $table->dropForeign(['pay_type_id']);
            $table->dropColumn('executor_id');
        });
    }
}
