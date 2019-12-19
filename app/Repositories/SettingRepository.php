<?php

namespace App\Repositories;


class SettingRepository
{
    const VEHICLE_CATEGORY_A = 'A';
    const VEHICLE_CATEGORY_B = 'B';
    const VEHICLE_CATEGORY_C = 'C';

    const DEFAULT_VEHICLE_CATEGORIES = [
        self::VEHICLE_CATEGORY_A,
        self::VEHICLE_CATEGORY_B,
        self::VEHICLE_CATEGORY_C,
    ];

    const DAILY_RATE = 'daily';
    const NIGHTLY_RATE = 'nightly';

    const DAILY_RATE_RANGE = [
        'from' => '08:00',
        'to' => '18:00'
    ];

    const NIGHTLY_RANGE_RANGE = [
        'from' => '18:00',
        'to' => '08:00'
    ];

    const SILVER = 'silver';
    const GOLD = 'gold';
    const PLATINUM = 'platinum';

    const DEFAULT_DISCOUNT_CARDS = [
        self::SILVER => 10,
        self::GOLD => 15,
        self::PLATINUM => 20
    ];

    const BILLING = [
        self::VEHICLE_CATEGORY_A => [
            self::DAILY_RATE => 3,
            self::NIGHTLY_RATE => 2,
        ],
        self::VEHICLE_CATEGORY_B => [
            self::DAILY_RATE => 6,
            self::NIGHTLY_RATE => 4,
        ],
        self::VEHICLE_CATEGORY_C => [
            self::DAILY_RATE => 12,
            self::NIGHTLY_RATE => 8,
        ],
    ];

    const AVAILABLE_PLACES = 200;

    const  TAKE_UP_SPACE = [
        self::VEHICLE_CATEGORY_A => 1,
        self::VEHICLE_CATEGORY_B => 2,
        self::VEHICLE_CATEGORY_C => 4
    ];
}