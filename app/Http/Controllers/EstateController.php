<?php

namespace App\Http\Controllers;

use App\BaseModel;
use App\Estate;
use App\Http\Requests\EstateRequestPost;
use App\Http\Requests\EstateRequestPut;

class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Estate::paginate(BaseModel::ITEMS_PER_PAGE));
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
     * @param  \App\Http\Requests\EstateRequestPost $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstateRequestPost $request)
    {
        return Estate::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estate $estate
     * @return \Illuminate\Http\Response
     */
    public function show(Estate $estate)
    {
        return response($estate);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estate $estate
     * @return \Illuminate\Http\Response
     */
    public function edit(Estate $estate)
    {
        return view('edit-contract', $estate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EstateRequestPut $request
     * @param  \App\Estate $estate
     * @return \Illuminate\Http\Response
     */
    public function update(EstateRequestPut $request, Estate $estate)
    {
        return parent::updateModel($request, $estate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estate $estate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estate $estate)
    {
        return parent::forceDelete($estate);
    }

    /**
     * Mark the specified resource as deleted from storage.
     *
     * @param \App\Estate $estate
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function delete(Estate $estate)
    {
        return parent::softDelete($estate);
    }

}
