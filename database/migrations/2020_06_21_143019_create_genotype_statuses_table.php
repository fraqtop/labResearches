<?php

use App\Services\GenotypeStatusService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGenotypeStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genotype_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        DB::table('genotype_statuses')->insert([
            ['name' => 'Норма'],
            ['name' => 'Гетерозигота'],
            ['name' => 'Мутация']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genotype_statuses');
    }
}
