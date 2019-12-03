<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Http\Requests\ContractsEstatesLessorsRequestPut;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class ContractsEstatesLessors extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $relations = DB::table('lessors')
            ->where('content_id', 'John')
            ->get();
        return response($relations);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Contract $contract
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(ContractsEstatesLessorsRequestPut $request)
    {
        $contractId = $request->route('id');

        $this->clearRelations($contractId);

        \App\ContractsEstatesLessors::insert(
            $this->prepareInsertData($contractId, $request->estates)
        );

        return response([
            'success' => true
        ]);
    }

    private function clearRelations(int $contractId): void
    {
        DB::table('contracts_estates_lessors')
            ->where('contract_id', '=', $contractId)
            ->delete();
    }

    private function prepareInsertData(int $contractId, array $estates): array
    {
        $insetData = [];
        foreach ($estates as $estate) {
            if (empty($estate['lessors'])) {
                $insetData[] = [
                    'contract_id' => $contractId,
                    'estate_id' => $estate['estate_id']
                ];
            } else {
                foreach (($estate['lessors'] ?? []) as $key => $value) {
                    $insetData[] = [
                        'contract_id' => $contractId,
                        'estate_id' => $estate['estate_id'],
                        'lessor_id' => $key,
                        'ownership' => $value,
                    ];
                }
            }
        }
        return $insetData;
    }
}
