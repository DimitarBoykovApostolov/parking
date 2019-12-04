<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\ContractsEstatesLessors;

class ContractsEstatesLessorsRepository
{
    public function clearRelations(int $contractId): void
    {
        DB::table('contracts_estates_lessors')
            ->where('contract_id', '=', $contractId)
            ->delete();
    }

    public function insert(int $contractId, array $estates) {
        ContractsEstatesLessors::insert(
            $this->prepareInsertData($contractId, $estates)
        );
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