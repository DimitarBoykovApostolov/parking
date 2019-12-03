<?php

namespace App\Http\Controllers;

use App\Contract;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function getReportOwedRent()
    {
        return response(DB::table('contracts_estates_lessors as cel')
            ->join('contracts as c', 'cel.contract_id', '=', 'c.id')
            ->join('estates as e', 'cel.estate_id', '=', 'e.id')
            ->join('lessors as l', 'cel.lessor_id', '=', 'l.id')
            ->select('c.*', 'e.*', 'l.*')
            ->where('c.type', '=', Contract::TYPE_RENT)
            ->get());
    }

    public function getReportOwnProperties()
    {
        return response(DB::table('contracts_estates_lessors as cel')
            ->join('contracts as c', 'cel.contract_id', '=', 'c.id')
            ->join('estates as e', 'cel.estate_id', '=', 'e.id')
            ->join('lessors as l', 'cel.lessor_id', '=', 'l.id')
            ->select('c.*', 'e.*', 'l.*')
            ->where('c.type', '=', Contract::TYPE_OWNERSHIP)
            ->get());
    }

}
