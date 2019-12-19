<?php

namespace App\Repositories;

use App\Parking;
use App\Setting;
use App\User;
use Illuminate\Http\Request;

class ParkingRepository
{
    /**
     * @param Request $request
     * @return array
     */
    public function getAvailablePlaces(Request $request)
    {
        $parking = Parking::findOrfail($request->route('id'));

        return [
            'available_places' => $this->getAvailablePlacesByParking($parking)
        ];
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function decrementAvailablePlaces(Request $request): bool
    {
        $setting = Setting::where('_id', $request->setting_id)->firstOrFail();
        return $this->updateAvailablePlaces($request->parking_id, $setting->take_up_places * -1);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function incrementAvailablePlaces(Request $request): bool
    {
        $user = User::where('license_plate', $request->route('license_plate'))->firstOrFail();
        return $this->updateAvailablePlaces($user->parking_id, $user->settings->take_up_places);
    }

    /**
     * @param Parking $parking
     * @return array
     */
    private function getAvailablePlacesByParking(Parking $parking): array
    {
        $settings = Setting::where('parking_id', $parking->_id)->get();

        $availablePlacesByCategory = [];
        foreach ($settings as $setting) {
            $availablePlacesByCategory[$setting->category] = $this->getCalculatedAvailablePlaces($parking, $setting);
        }

        return $availablePlacesByCategory;
    }

    /**
     * @param Parking $parking
     * @param Setting $setting
     * @return int
     */
    private function getCalculatedAvailablePlaces(Parking $parking, Setting $setting): int
    {
        return $parking->available_places / $setting->take_up_places;
    }

    /**
     * @param string $parkingId
     * @param int $count
     * @return bool
     */
    private function updateAvailablePlaces(string $parkingId, int $count): bool
    {
        $parking = Parking::where('_id', $parkingId)->firstOrFail();

        return $parking->update([
            'available_places' => $parking->available_places + $count
        ]);
    }

}