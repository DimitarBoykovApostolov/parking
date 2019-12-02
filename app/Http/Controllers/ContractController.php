<?php

namespace App\Http\Controllers;

use App\BaseModel;
use App\Contract;
use App\Http\Requests\ContractRequestPost;
use App\Http\Requests\ContractRequestPut;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Contract::paginate(BaseModel::ITEMS_PER_PAGE));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-contract');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContractRequestPost $request)
    {
        return Contract::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        return response($contract);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        return view('edit-contract', $contract);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function update(ContractRequestPut $request, Contract $contract)
    {
        if ($contract->update($request->all())) {
            $result = response($contract);
        } else {
            throw new HttpResponseException(
                response(
                    [
                        'error_massge' => __('Something went wrong')
                    ],
                    400
                )
            );
        }

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        if (!empty($contract->forceDelete())) {
            return response([
                'success' => true,
                'status' => 'Profile deleted successfully!'
            ]);
        } else {
            return response([
                'success' => false
            ], 400);
        }
    }

    /**
     * Mark the specified resource as deleted from storage.
     *
     * @param Contract $contract
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function delete(Contract $contract)
    {
        if (!empty($contract->delete())) {
            return response([
                'success' => true,
                'status' => 'Profile deleted successfully!'
            ]);
        } else {
            return response([
                'success' => false
            ], 400);
        }
    }

}
