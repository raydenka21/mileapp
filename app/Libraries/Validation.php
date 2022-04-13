<?php

namespace App\Libraries;


class Validation
{
    public static function valid() : array
    {
        $validation = [
            'customer_name'=> [
                'type'=>'string',
                'required' => 'required',
                'min' => '',
                'max' => '',
            ]
        ];
        return $validation;

    }
}





