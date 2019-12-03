<?php

namespace App\Http\Controllers;

use App\BaseModel;
use App\Http\Requests\LessorRequestPost;
use App\Http\Requests\LessorRequestPut;
use App\Lessor;
use Illuminate\Http\Exceptions\HttpResponseException;

class LessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Lessor::paginate(BaseModel::ITEMS_PER_PAGE));
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
    public function store(LessorRequestPost $request)
    {
        return Lessor::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contract $lessor
     * @return \Illuminate\Http\Response
     */
    public function show(Lessor $lessor)
    {
        return response($lessor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract $lessor
     * @return \Illuminate\Http\Response
     */
    public function edit(Lessor $lessor)
    {
        return view('edit-contract', $lessor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Contract $lessor
     * @return \Illuminate\Http\Response
     */
    public function update(LessorRequestPut $request, Lessor $lessor)
    {
        if ($lessor->update($request->all())) {
            $result = response($lessor);
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
     * @param  \App\Lessor $lessor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lessor $lessor)
    {
        if (!empty($lessor->forceDelete())) {
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
     * @param \App\Lessor $lessor
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function delete(Lessor $lessor)
    {
        if (!empty($lessor->delete())) {
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
