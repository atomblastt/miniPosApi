<?php

use Illuminate\Http\Response;

// use function PHPSTORM_META\type;

class Helper
{

    public static function generalResponse($status, $message, $data, $code='',  $httpstatus=200){
        $response = [
            "status"=>$status,
            "message"=>$message,
            "data"=>$data
        ];
        if(!!$code){
            $response['code']=$code;
        }
        return response()->json($response, $httpstatus);
    
    }

}

