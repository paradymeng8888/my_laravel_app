<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestApiController extends Controller
{
    public function test1(){
        $students = [
            [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john@example.com',
            ],
            [
                'id' => 2,
                'name' => 'Steav Takeo',
                'email' => 'steav@example.com',
            ],
            [
                'id' => 3,
                'name' => 'Tung Tung Sahur',
                'email' => 'tung@example.com',
            ],
        ];
        return response()->json($students);
    }
}
