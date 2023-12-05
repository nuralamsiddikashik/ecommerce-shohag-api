<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index()
    {
        return ok( 'Hello Ecommerce API' );
    }
}
