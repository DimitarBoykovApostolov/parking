<?php

namespace App\Repositories;

use App\DiscountCard;
use App\Http\Requests\BaseRequest;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use \DateTime;

class UserRepository
{

    /**
     * @param BaseRequest $request
     * @return mixed
     */
    public function register(BaseRequest $request)
    {
        $discountCard = DiscountCard::where('name', $request->discount_card)->firstOrFail();

        return User::create([
            'license_plate' => $request->license_plate,
            'parking_id' => $request->parking_id,
            'card_id' => $discountCard->_id,
            'setting_id' => $request->setting_id,
        ]);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function unregister(Request $request)
    {
        $user = User::where('license_plate', $request->route('license_plate'))->firstOrFail();
        $currentFee = $this->getCurrentFee($request);
        $user->forceDelete();

        return $currentFee;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function getCurrentFee(Request $request): array
    {
        $user = User::where('license_plate', $request->route('license_plate'))->firstOrFail();

        $dateTo = new DateTime('now', new \DateTimeZone("UTC"));
        $dateTo->modify('+1 minutes');
        $timeFormat = 'Y-m-d H:i:s';

        $allHours = $this->getHoursBetweenDates($user->created_at, $dateTo->format($timeFormat));
        $dailyHours = $this->getDailyHoursByInterval($user->created_at, $dateTo->format($timeFormat), $user->settings->daily_from, $user->settings->daily_to);
        $nightly = max(($allHours - $dailyHours), 0);

        return [
            'current_fee' => $this->calculateFee($dailyHours, $nightly, $user->settings, $user->discount_card)
        ];
    }

    /**
     * @param int $dailyHours
     * @param int $nightly
     * @param Setting $settings
     * @param DiscountCard|null $card
     * @return float|int
     */
    private function calculateFee(int $dailyHours, int $nightly, Setting $settings, DiscountCard $card = null): float
    {
        $fee = (($dailyHours * $settings->daily_rate) + ($nightly * $settings->nightly_rate));

        if (!empty($card)) {
            $fee = $fee - (($card->discount_percentage / 100) * $fee);
        }

        return number_format($fee, 2, '.', '');
    }

    /**
     * @param string $from
     * @param string $to
     * @return int
     * @throws \Exception
     */
    private function getHoursBetweenDates(string $from, string $to): int
    {
        $dateFrom = new DateTime($from);
        $dateTo = new DateTime($to);
        $diff = $dateTo->diff($dateFrom);
        return (int)$diff->format('%h');
    }

    /**
     * @param string $from
     * @param string $to
     * @param string $dailyStartHour
     * @param string $dailyEndHour
     * @return float
     */
    private function getDailyHoursByInterval(string $from, string $to, string $dailyStartHour, string $dailyEndHour): float
    {
        $fromTimestamp = strtotime($from);
        $toTimestamp = strtotime($to);
        $workdaySeconds = abs(strtotime($dailyStartHour) - strtotime($dailyEndHour));

        $workdaysNumber = count($this->getWorkdays(date('Y-m-d', $fromTimestamp), date('Y-m-d', $toTimestamp))) - 1;
        $workdaysNumber = $workdaysNumber < 0 ? 0 : $workdaysNumber;

        $startTimeInSeconds = date("H", $fromTimestamp) * 3600 + date("i", $fromTimestamp) * 60;
        $endTimeInSeconds = date("H", $toTimestamp) * 3600 + date("i", $toTimestamp) * 60;
        $workingHours = ($workdaysNumber * $workdaySeconds + $endTimeInSeconds - $startTimeInSeconds) / 86400 * 24;

        return ceil($workingHours);
    }

    /**
     * @param $from
     * @param $to
     * @return array
     */
    private function getWorkdays($from, $to): array
    {
        $days = [];
        $skipdays = [];
        $skipdates = $this->getHolidays();

        $i = 0;
        $current = $from;

        if ($current == $to) // same dates
        {
            $timestamp = strtotime($from);
            if (!in_array(date("l", $timestamp), $skipdays) && !in_array(date("Y-m-d", $timestamp), $skipdates)) {
                $days[] = date("Y-m-d", $timestamp);
            }
        } elseif ($current < $to) // different dates
        {
            while ($current < $to) {
                $timestamp = strtotime($from . " +" . $i . " day");
                if (!in_array(date("l", $timestamp), $skipdays) && !in_array(date("Y-m-d", $timestamp), $skipdates)) {
                    $days[] = date("Y-m-d", $timestamp);
                }
                $current = date("Y-m-d", $timestamp);
                $i++;
            }
        }

        return $days;
    }

    /**
     * You have to put there your source of holidays and make them as array
     *
     * @return array
     */
    private function getHolidays(): array
    {
        return [];
    }
}