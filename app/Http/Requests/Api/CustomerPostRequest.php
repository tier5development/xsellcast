<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Request;
use Response;
class CustomerPostRequest extends Request
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
            'wp_userid'    => 'required|unique:user_customer,wp_userid',
            'address1'     => 'required',
            'address2'     => '',
            'zip'          => 'required',
            'city'         => 'required',
            'state'        => 'required',
            'geo_long'     => '',
            'geo_lat'      => '',
            'email'        => 'required|unique:users,email',
            'firstname'    => 'required',
            'lastname'     => 'required',
            'homephone'    => '',
            'cellphone'    => '',
            'officephone'  => '',
            'password'        => 'required|min:6'

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
        // return Response::json($errors, config('responses.bad_request.status_code'));
    }
}
