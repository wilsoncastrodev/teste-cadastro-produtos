<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response($response, 201);
    }

    public function sendError($message, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response($response, $code);
    }
}
