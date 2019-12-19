<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Repositories\SettingRepository;
use Illuminate\Support\Facades\DB;

class DiscountCardSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $discountCards = [];
        foreach (SettingRepository::DEFAULT_DISCOUNT_CARDS as $name => $discount) {
            $discountCards[] = [
                'name' => $name,
                'discount_percentage' => $discount,
                'created_at' => Carbon::now()->toDateTimeString()
            ];
        }

        DB::table('discount_card')->insert($discountCards);
    }
}
