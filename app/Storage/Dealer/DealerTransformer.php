<?php

namespace App\Storage\Dealer;

use League\Fractal\TransformerAbstract;
use App\Storage\Dealer\Dealer;

/**
 * Class DealerTransformer
 * @package namespace App\Storage\Dealer;
 */
class DealerTransformer extends TransformerAbstract
{

    /**
     * Transform the \Dealer entity
     * @param \Dealer $model
     *
     * @return array
     */
    public function transform(Dealer $model)
    {
        return [
            'id'         => (int) $model->id,
            'wpid'       => (int) $model->wpid,

            /* place your other model properties here */
            'name'          => $model->name,
            'address1'      => $model->address1,
            'street_name'   => $model->street_name,
            'street'        => $model->street,
            'apt'           => $model->apt,
            'fax'           => $model->fax,
            'website'       => $model->website,
            'city'          => $model->city,
            'zip'           => $model->zip,
            'state'         => $model->state,
            'country'       => $model->country,
            'phone'         => $model->phone,
            'email'         => $model->email,
            'geo_long'      => $model->geo_long,
            'geo_lat'       => $model->geo_lat,
            'county'        => $model->county,
            'country_code'  => $model->country_code,
            'outlet'        => $model->outlet,
            'distributor_name'=> $model->distributor_name,
            'rep_name'      => $model->rep_name,
            'rep_email'     => $model->rep_email,
            'brand'         => $model->brands,
            'created_at'    => $model->created_at,
            'updated_at'    => $model->updated_at,
        ];
    }
}