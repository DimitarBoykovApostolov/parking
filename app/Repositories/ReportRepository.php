<?php

namespace App\Repositories;

use App\BaseModel;
use App\Contract;
use App\Http\Requests\BaseRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ReportRepository
{
    private function setFilters(BaseRequest $request, Builder $builder)
    {
        //TODO: fix filters;
//        if (!empty($request->contractNumber)) {
//            $builder->where('c.number', '=', '?');
//            $builder->addBinding($request->contractNumber);
//        }
//        if (!empty($request->estateNumber)) {
//            $builder->where('e.unique_number', '=', '?');
//            $builder->addBinding($request->estateNumber);
//        }
//        if (!empty($request->lessorName)) {
//            $builder->where(DB::raw('c.first_name LIKE %?% OR c.last_name LIKE %?%'));
//            $builder->addBinding($request->lessorName);
//            $builder->addBinding($request->lessorName);
//        }
//        if (!empty($request->date)) {
//            $builder->where('c.start_date', '<=', '?')->orWhere('c.end_date', '>=');
//            $builder->addBinding($request->date);
//            $builder->addBinding($request->date);
//        }

        return $builder;
    }

    /**
     * @param BaseRequest $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getReportOwnedRent(BaseRequest $request)
    {
        $builder = DB::table('contracts_estates_lessors as cel');

        $builder->select(
            'c.number',
            'c.start_date',
            'c.end_date',
            'e.unique_number',
            'e.area_in_acres',
            DB::raw('first_name as name'),
            DB::raw('((cel.ownership / 100) * e.area_in_acres) as own_ideal_part'),
            DB::raw('(c.rent_per_acre * ((cel.ownership / 100) * e.area_in_acres)) as owner_rent'),
            DB::raw('(e.area_in_acres * c.rent_per_acre) as full_rent_price')
        )
            ->join('contracts as c', 'cel.contract_id', '=', 'c.id')
            ->join('estates as e', 'cel.estate_id', '=', 'e.id')
            ->join('lessors as l', 'cel.lessor_id', '=', 'l.id')
            ->where('c.type', '=', Contract::TYPE_RENT)
            ->orderByDesc('c.start_date');

        $builder = $this->setFilters($request, $builder);

        return $builder->paginate(BaseModel::ITEMS_PER_PAGE);
    }

    /**
     * @param BaseRequest $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getReportOwnProperties(BaseRequest $request)
    {
        $builder = DB::table('contracts_estates_lessors as cel');

        $builder->select(
            'c.number',
            'c.start_date',
            'e.area_in_acres',
            'c.price',
            'c.rent_per_acre'
        )
            ->leftJoin('contracts as c', 'cel.contract_id', '=', 'c.id')
            ->leftJoin('estates as e', 'cel.estate_id', '=', 'e.id')
            ->where('c.type', '=', Contract::TYPE_OWNERSHIP)
            ->orderByDesc('c.start_date');

        $builder = $this->setFilters($request, $builder);

        return $builder->paginate(BaseModel::ITEMS_PER_PAGE);
    }

}