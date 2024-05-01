<?php

namespace App\Http\Controllers\Api ;
use App\Http\Controllers\Controller;


class BaseController extends Controller
{
    public function SendResponse($response , $status = 'success' , $code = 200)
    {
        return response()->json(['data'=>$response ,'status'=>$status], $code);

    }
}
