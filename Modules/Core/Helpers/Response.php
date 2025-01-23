<?php

use Illuminate\Http\JsonResponse;
use Modules\Core\Enums\ResponseCode;

if (!function_exists('successResponse')) {
    function successResponse($data, $message = ''): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message !== '' ? $message : ("success")
        ]);
    }
}

if (!function_exists('failedResponse')) {
    function failedResponse($message, $code = ResponseCode::SERVER_ERROR): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $code);
    }
}

if (!function_exists('fileResponse')) {
    function fileResponse($data)
    {
        $file = $data['file'];
        $type = $data['type'];
        return Response::make($file, 200)->header("Content-Type", $type);
    }
}
