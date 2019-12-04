<?php

namespace App\Http\Controllers;

use App\BaseModel;
use App\Http\Requests\LessorRequestPost;
use App\Http\Requests\LessorRequestPut;
use App\Lessor;

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
     * @param  \App\Http\Requests\LessorRequestPost $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessorRequestPost $request)
    {
        return Lessor::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lessor $lessor
     * @return \Illuminate\Http\Response
     */
    public function show(Lessor $lessor)
    {
        return response($lessor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lessor $lessor
     * @return \Illuminate\Http\Response
     */
    public function edit(Lessor $lessor)
    {
        return view('edit-contract', $lessor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\LessorRequestPut $request
     * @param  \App\Lessor $lessor
     * @return \Illuminate\Http\Response
     */
    public function update(LessorRequestPut $request, Lessor $lessor)
    {
        return parent::updateModel($request, $lessor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lessor $lessor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lessor $lessor)
    {
        return parent::forceDelete($lessor);
    }

    /**
     * Mark the specified resource as deleted from storage.
     *
     * @param Lessor $lessor
     * @throws \Exception
     */
    public function delete(Lessor $lessor)
    {
        parent::softDelete($lessor);
    }
}
