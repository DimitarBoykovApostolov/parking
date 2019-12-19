<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Repositories\SettingRepository;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->fillSettings($this->fillParking());
    }

    private function fillParking(): string
    {
        $parkingId = DB::table('parking')->insertGetId([
            'name' => 'lab08',
            'capacity' => SettingRepository::AVAILABLE_PLACES,
            'available_places' => SettingRepository::AVAILABLE_PLACES,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        return (string)$parkingId;
    }

    private function fillSettings(string $parkingId): void
    {
        $discountCards = [];
        foreach (SettingRepository::DEFAULT_VEHICLE_CATEGORIES as $vehicleCategory) {

            $discountCards[] = [
                'parking_id' => $parkingId,
                'category' => $vehicleCategory,
                'daily_from' => SettingRepository::DAILY_RATE_RANGE['from'],
                'daily_to' => SettingRepository::DAILY_RATE_RANGE['to'],
                'daily_rate' => SettingRepository::BILLING[$vehicleCategory][SettingRepository::DAILY_RATE],
                'nightly_from' => SettingRepository::NIGHTLY_RANGE_RANGE['from'],
                'nightly_to' => SettingRepository::NIGHTLY_RANGE_RANGE['to'],
                'nightly_rate' => SettingRepository::BILLING[$vehicleCategory][SettingRepository::NIGHTLY_RATE],
                'take_up_places' => SettingRepository::TAKE_UP_SPACE[$vehicleCategory],
                'created_at' => Carbon::now()->toDateTimeString()
            ];
        }

        DB::table('setting')->insert($discountCards);
    }
}
