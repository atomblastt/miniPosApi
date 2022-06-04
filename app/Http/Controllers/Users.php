<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Helper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class Users extends Controller
{
    public function login(Request $request)
    {
      if (!$request->get('username')) {
          return Helper::generalResponse('01', 'Unknown request', []);
          exit;
      }  

      $user =   User::where([
                    ['username','=', $request->get('username')],
                    ['password','=', SHA1($request->get('password'))]
                ])->first();

      if (!!$user) {
            return Helper::generalResponse('00', 'Success', [$user]);
        }else{
          return Helper::generalResponse('01', 'User not Found', []);
      }
    }

    private static function rule()
    {
        $return = [
            'merchant_name'         => 'required|max:50|unique:merchants,merchant_name',
            // 'status'                => 'required|in:ACTIVE,INACTIVE',
            'merchant_brand'        => 'required',
            'pic_business_name'     => "required",
            "pic_business_email"    => "required|email|unique:users,email",
            "pic_business_phone"    => "required",
            "password"              => "required"
        ];
        return $return;
    }

    public function confirmUser($key)
    {
        $email = explode("-",$key);

        if (count($email) != 2) {
            return Helper::generalResponse(true, 'URL Invalid', []);
        }
        
        $userManager = app(UserManagerInterface::class);
        $data = $userManager->getUser($email[0], $key);
        
        if (is_null($data)) {
            return Helper::generalResponse(true, 'Data Not Found', []);
        }

        $userManager->activedUser($data);

        return response(null, 201);
    }
}
