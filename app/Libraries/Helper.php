<?php

namespace App\Libraries;


class Helper
{
    public static function responseApp($status,$message=null,$data=null) : array
    {
        $output = [
            'status' => $status,
            'message' => $message,
            'data'=> $data
        ];
        return $output;
    }
}





