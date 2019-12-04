<?php

namespace App\Http\Controllers;

use App\BaseModel;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BaseRequest $request
     * @param  \App\BaseModel $model
     * @return \Illuminate\Http\Response
     */
    public function updateModel(BaseRequest $request, BaseModel $model)
    {
        if ($model->update($request->all())) {
            $result = response($model);
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
     * @param  \App\BaseModel $model
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(BaseModel $model)
    {
        if (!empty($model->forceDelete())) {
            return response([
                'success' => true,
                'status' => 'Resource deleted successfully!'
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
     * @param \App\BaseModel $model
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function softDelete(BaseModel $model)
    {
        if (!empty($model->delete())) {
            return response([
                'success' => true,
                'status' => 'Resource deleted successfully!'
            ]);
        } else {
            return response([
                'success' => false
            ], 400);
        }
    }
}
