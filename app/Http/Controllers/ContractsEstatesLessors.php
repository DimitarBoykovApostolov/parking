<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractsEstatesLessorsRequestPut;
use App\Repositories\ContractsEstatesLessorsRepository;

class ContractsEstatesLessors extends Controller
{
    private $contractRepository;

    public function __construct(ContractsEstatesLessorsRepository $contractRepository)
    {
        $this->contractRepository = $contractRepository;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContractsEstatesLessorsRequestPut $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(ContractsEstatesLessorsRequestPut $request)
    {
        $contractId = $request->route('id');
        $this->contractRepository->clearRelations($contractId);
        $this->contractRepository->insert($contractId, $request->estates);

        return response([
            'success' => true
        ]);
    }

}
