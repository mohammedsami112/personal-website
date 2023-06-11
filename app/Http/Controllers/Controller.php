<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function successResponse(string $message = 'Success', mixed $payload = [], int $code = 200) {
        return response()->json([
            'success' => true,
            'data' => $payload,
            'message' => $message
        ], $code);
    }

    public function failResponse(String $message = 'Bad Request', mixed $payload = [], int $code = 400) {
        return response()->json([
            'success' => false,
            'errors' => $payload,
            'message' => $message
        ], $code);
    }

}
