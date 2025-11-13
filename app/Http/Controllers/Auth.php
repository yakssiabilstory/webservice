<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Auth extends Controller
{
    public function index() {
        $res = [
            'code'=>200,
            'status'=>"ok",
            'data'=>[]
        ];
        return response()->json($res);
    }
}
