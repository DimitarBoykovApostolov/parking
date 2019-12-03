<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContractsEstatesLessors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts_estates_lessors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('contract_id');
            $table->foreign('contract_id')
                ->references('id')
                ->on('contracts')
                ->onDelete('cascade');
            $table->unsignedBigInteger('estate_id');
            $table->foreign('estate_id')
                ->references('id')
                ->on('estates')
                ->onDelete('cascade');
            $table->unsignedBigInteger('lessor_id')->nullable(true);
            $table->foreign('lessor_id')
                ->references('id')
                ->on('lessors')
                ->onDelete('cascade');
            $table->decimal('ownership')->nullable(true);
            $table->unique([
                'contract_id',
                'estate_id',
                'lessor_id'
            ]);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts_estates_lessors');
    }
}
