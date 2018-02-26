<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Request;
use App\Storage\Customer\Customer;

class CustomerPutRequest extends Request
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
        $customerId = $this->get('customer_id');
        $customer   = Customer::find($customerId);
        $wpIdRules  = 'unique:user_customer,wp_userid';
        $emailRules = 'unique:users,email';

        if($customer)
        {
            $wpIdRules .= ',' . $customer->id;
            $emailRules .= ',' . $customer->user->id;
        }

   //     $this->attributes->add(['customer' => $customer]);

        return [
            'access_token' => 'required',
            'customer_id'  => 'required|exists:user_customer,id',
            'wp_userid'    => $wpIdRules,
            'address1'     => '',
            'address2'     => '',
            'zip'          => '',
            'city'         => '',
            'state'        => '',
            'geo_long'     => '',
            'geo_lat'      => '',
            'email'        => $emailRules,
            'firstname'    => '',
            'lastname'     => '',
            'cellphone'    => '',
            'officephone'  => '',
            'homephone'    => ''
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
