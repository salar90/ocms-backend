<?php
namespace App\Traits;

trait HasJsonResponse{
    private function jsonResponse($data, $message = '', $status = 200, $headers = [])
    {
        $data = [
            'data' => $data,
            'code' => $status,
            'message' => $message,
        ];
        return response()->json($data, $status, $headers);
    }
}