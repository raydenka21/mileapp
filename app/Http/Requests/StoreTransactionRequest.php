<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use PaymentType;
use CustomerType;


class StoreTransactionRequest extends FormRequest
{
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
    public function rules() : array
    {

        return [
            'customer_name' => ['required', 'string','min:3','max:50'],
            'customer_code' => ['required', 'integer'],
            'transaction_amount' => ['required', 'numeric'],
            'transaction_discount' => ['required', 'numeric'],
            'transaction_additional_field' => ['nullable', 'numeric'],
            'transaction_payment_type' => ['required', 'integer'],
            'transaction_state' => ['required', Rule::in(PaymentType::$paymentType)],
            'transaction_code' => ['required', 'string'],
            'transaction_order' => ['required', 'integer'],
            'location_id' => ['required', 'string'],
            'organization_id' => ['required', 'integer'],
            'transaction_payment_type_name' => ['required', 'string'],
            'transaction_cash_amount' => ['required', 'numeric'],
            'transaction_cash_change' => ['required', 'numeric'],
            'connote_id' => ['required', 'string'],
            'customer_attribute' => ['required', 'array'],
            'customer_attribute.Nama_Sales' => ['required', 'string'],
            'customer_attribute.TOP' => ['required', 'string'],
            'customer_attribute.Jenis_Pelanggan' => ['required', Rule::in(CustomerType::$customerType)],
            'origin_data' => ['required', 'array'],
            'origin_data.customer_name' => ['required', 'string'],
            'origin_data.customer_address' => ['required', 'string'],
            'origin_data.customer_email' => ['required', 'email'],
            'origin_data.customer_phone' => ['required', 'string'],
            'origin_data.customer_address_detail' => ['nullable', 'string'],
            'origin_data.customer_zip_code' => ['required', 'integer'],
            'origin_data.zone_code' => ['required', 'string'],
            'origin_data.organization_id' => ['required', 'integer'],
            'origin_data.location_id' => ['required', 'string'],
            'destination_data' => ['required', 'array'],
            'destination_data.customer_name' => ['required', 'string'],
            'destination_data.customer_address' => ['required', 'string'],
            'destination_data.customer_email' => ['required', 'email'],
            'destination_data.customer_phone' => ['required', 'numeric'],
            'destination_data.customer_address_detail' => ['required', 'string'],
            'destination_data.customer_zip_code' => ['required', 'integer'],
            'destination_data.zone_code' => ['required', 'string'],
            'destination_data.organization_id' => ['required', 'integer'],
            'destination_data.location_id' => ['required', 'string'],
            'koli_data' => ['required', 'array'],
            'koli_data.*.koli_length' => ['required', 'numeric'],
            'koli_data.*.awb_url' => ['required', 'url'],
            'koli_data.*.koli_chargeable_weight' => ['required', 'numeric'],
            'koli_data.*.koli_width' => ['required', 'numeric'],
            'koli_data.*.koli_surcharge' => ['nullable','array'],
            'koli_data.*.koli_height' => ['required', 'numeric'],
            'koli_data.*.koli_description' => ['required', 'string'],
            'koli_data.*.koli_formula_id' => ['nullable', 'numeric'],
            'koli_data.*.connote_id' => ['required', 'string'],
            'koli_data.*.koli_volume' => ['required', 'numeric'],
            'koli_data.*.koli_weight' => ['required', 'numeric'],
            'koli_data.*.koli_id' => ['required', 'string'],
            'koli_data.*.koli_custom_field' => ['nullable', 'array'],
            'koli_data.*.koli_code' => ['required', 'string'],
            'custom_field' => ['required', 'array'],
            'custom_field.catatan_tambahan' => ['nullable', 'string'],
            'currentLocation' => ['required', 'array'],
            'currentLocation.name' => ['required', 'string'],
            'currentLocation.code' => ['required', 'string'],
            'currentLocation.type' => ['required', 'string'],
        ];
    }

//    public function messages()
//    {
//        return [
//            'koli_data.*.koli_volume.required' => 'Gak boleh kosong',
//        ];
//    }
    protected function failedValidation(Validator $validator) : object
    {

        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
