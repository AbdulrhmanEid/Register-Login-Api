<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use App\Requests\Users\CreateUserValidator;
use App\Requests\Users\LoginUserValidator;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController
{
    public $userService ;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function register(CreateUserValidator $createUserValidator)
    {
        if(!empty($createUserValidator->getErrors())){
            return response()->json($createUserValidator->getErrors(), 400);
        }

        $user = $this->userService->createUser($createUserValidator->request()->all());
        $message ['user']  = $user ;
        $message ['token'] = $user->createToken('My App')->plainTextToken;

        return $this->SendResponse($message);

    }

    public function login(LoginUserValidator $loginUserValidator)
    {
        if(!empty($loginUserValidator->getErrors())){
            return response()->json($loginUserValidator->getErrors(),406);
        }


        $request = $loginUserValidator->request();
        if(Auth::attempt(['email'=>$request->email ,'password'=>$request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('My App')->plainTextToken ;
            $success ['user'] = $user->name ;
            return $this->SendResponse($success);
        }

        else
        {
            return $this->SendResponse('unauthrized' , 401);
        }


    }

}
