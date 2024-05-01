<?php


namespace App\Requests\Users ;

use App\Requests\BaseRequestFormApi;

class CreateUserValidator extends BaseRequestFormApi
{

    public function rules() : array
    {

        return [
            'name' =>'required|string|max:255',
            'email' =>'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed ',
        ];

    }

    public function authorized() : bool
    {
        return true;

    }
}
