<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function sendResponse(bool $status, string $method, string $model = 'Data')
    {
        $statusRespone = $status ? 'success' : 'error';
        $statusMessage = $status ? 'Berhasil' : 'Gagal';
        $code = $status ? 200 : 422;

        $response = [
            'status' => $statusRespone,
            'message' => $model . ' ' . $statusMessage . ' Di' . $method,
        ];

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
        $message = $status ? 'Data ditemukan' : 'Data tidak ditemukan';
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
}
