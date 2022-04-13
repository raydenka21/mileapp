<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Validation;

class PatchTransactionRequest extends FormRequest
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
    public function rules()
    {
        $validation = Validation::valid();
        $field = [];
        foreach ($validation as $key => $value) {
            foreach ($value as $index => $item) {
                if($item){
                    $field[$key][$index] = $item;
                }

            }
        }
        return $field;
    }
    protected function failedValidation(Validator $validator) : object
    {

        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
