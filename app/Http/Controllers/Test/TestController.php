<?php

namespace App\Http\Controllers\Test;

use App\Helpers\Common\JResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    public function test(): JsonResponse
    {
        return JResponse::success('Test api success');
    }
}
