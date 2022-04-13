<?php

namespace App\Http\Struct;
use Ramsey\Uuid\Uuid;
use App\Models\Connote;


class StructTransaction
{
    public static function format($request,$method) : array
    {
        $uuid = Uuid::uuid4()->toString();
        $connoteId = $request->get('connote_id');
        $koli = $request->get('koli_data');
        $today = date('Y-m-d H:i:s');
        foreach ($koli as $key => $value){
            if($method=='CREATE'){
                $koli[$key]['created_at'] = $today;
            }
            $koli[$key]['updated_at'] = $today;
        }
        $data = [
            "transaction_id"=> $uuid,
            "customer_name" => $request->get('customer_name'),
            "customer_code" => $request->get('customer_code'),
            "transaction_amount" => $request->get('transaction_amount'),
            "transaction_discount" => $request->get('transaction_discount'),
            "transaction_additional_field" => $request->get('transaction_additional_field'),
            "transaction_payment_type" => $request->get('transaction_payment_type'),
            "transaction_state" => $request->get('transaction_state'),
            "transaction_code" => $request->get('transaction_code'),
            "transaction_order" => $request->get('transaction_order'),
            "location_id" => $request->get('location_id'),
            "organization_id" => $request->get('organization_id'),
            "transaction_payment_type_name" => $request->get('transaction_payment_type_name'),
            "transaction_cash_amount" => $request->get('transaction_cash_amount'),
            "transaction_cash_change" => $request->get('transaction_cash_change'),
            "cannote_id" => $connoteId,
            "customer_attribute" => $request->get('customer_attribute'),
            "origin_data" => $request->get('origin_data'),
            "destination_data" => $request->get('destination_data'),
            "koli_data" => $koli,
            "custom_field" => $request->get('custom_field'),
            "currentLocation" => $request->get('currentLocation')
        ];
        if($method=='UPDATE'){
            unset($data['transaction_id']);
        }
        return $data;
    }

}





