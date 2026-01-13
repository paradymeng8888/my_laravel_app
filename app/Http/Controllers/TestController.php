<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    function test()
    {
        return 'testing Controller';
    }

    function test2()
    {
        return response()->json([
            'message' => 'Hello World',
            'status' => 'success',
        ]);
    }
}
