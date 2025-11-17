<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function sendResponse(bool $status, string $method, string $model = 'Data', ?string $redirect = null)
    {
        $statusRespone = $status ? 'success' : 'error';
        $statusMessage = $status ? 'Berhasil' : 'Gagal';
        $code = $status ? 200 : 422;

        $response = [
            'status' => $statusRespone,
            'message' => $model . ' ' . $statusMessage . ' Di' . $method,
        ];

        if(!empty($redirect)){
            $response['redirect'] = $redirect;
        }

        return response()->json($response, $code);
    }

    public static function fetchResponse(bool $status, $data = null)
    {
        $message = $status ? 'Data ditemukan' : 'Data tidak ditemukan';
        $code = $status ? 200 : 404;
        $statusRespone = $status ? 'success' : 'error';

        $response = [
            'status' => $statusRespone,
            'message' => $message,
            'data' => $status ? $data : []
        ];

        return response()->json($response, $code);
    }

    public static function responseWithMeta(bool $status, $data = null)
    {
        $message = $data->isNotEmpty() ? 'Data ditemukan' : 'Data tidak ditemukan';
        $code = $status ? 200 : 404;
        $statusRespone = $status ? 'success' : 'error';

        $meta = [
            'current_page' => $data->currentPage(),
            'per_page' => $data->perPage(),
            'total' => $data->total(),
            'last_page' => $data->lastPage(),
            'from' => $data->firstItem(),
            'to' => $data->lastItem(),
        ];

        $response = [
            'status' => $statusRespone,
            'message' => $message,
            'data' => $status ? $data : [],
            'meta' => $meta,
        ];

        return response()->json($response, $code);
    }

    public static function errorResponse($message, $code)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $code);
    }
}
