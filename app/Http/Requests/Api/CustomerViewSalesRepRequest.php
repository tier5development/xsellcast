<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Request;

class CustomerViewSalesRepRequest extends Request
{
    protected $redirectRoute = 'api.errors';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'access_token' => 'required',
            'customer_id'  => 'required|integer|exists:user_customer,id',
            'page'         => 'integer',
            'limit'        => 'integer',
            'filter_by'    => 'in:approved,rejected'
        ];
    }
     /**
     * Response error message as json
     *
     * @param array $errors
     * @return mixed
     */
    public function response(array $errors){

        return response()->json([
                    'status'=>false,
                    'code'=>config('responses.bad_request.status_code'),
                    'data'=>null,
                    'errors'=>$errors,
                    'message'=>config('responses.bad_request.status_message'),
                ],
                config('responses.bad_request.status_code')
            );
    }
}