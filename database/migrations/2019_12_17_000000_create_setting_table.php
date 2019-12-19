<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Repositories\SettingRepository;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parking_id')->index('parking_id');
            $table->enum('category', [
                SettingRepository::VEHICLE_CATEGORY_A,
                SettingRepository::VEHICLE_CATEGORY_B,
                SettingRepository::VEHICLE_CATEGORY_C
            ])->index('category');
            $table->time('daily_from');
            $table->time('daily_to');
            $table->float('daily_rate');
            $table->time('nightly_from');
            $table->time('nightly_to');
            $table->float('nightly_rate');
            $table->tinyInteger('take_up_places');
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
        Schema::dropIfExists('setting');
    }
}
