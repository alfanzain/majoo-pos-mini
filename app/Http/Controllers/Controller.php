<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function responseSuccess($message = '', $data = []) {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ]);
    }

    protected function responseError($message = '') {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ]);
    }
}
