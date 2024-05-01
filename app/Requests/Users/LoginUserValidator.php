<?php


namespace App\Requests\Users ;

use App\Requests\BaseRequestFormApi;

class LoginUserValidator extends BaseRequestFormApi
{

    public function rules() : array
    {

        return [

            'email' =>'required|string|email|max:255',
            'password' => 'required ',
        ];

    }

    public function authorized() : bool
    {
        return true;

    }
}
