<?php

namespace App\Helper\Response;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ResponseHelper
{
    /**
     * Başarılı bir yanıt döndürür.
     *
     * @param string $message
     * @param array $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function success($message = 'Success', $data = [], $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'icon' => 'success',
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    /**
     * Hatalı bir yanıt döndürür.
     *
     * @param string $message
     * @param array $errors
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function error($message = 'Error', $errors = [], $statusCode = 400): JsonResponse
    {
        // Hata loglama
        Log::error($message, ['errors' => $errors]);

        return response()->json([
            'status' => false,
            'icon' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }

    /**
     * İstek yapısı doğrulama hataları için yanıt döndürür.
     *
     * @param array $validationErrors
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function validationError($validationErrors, $statusCode = 422): JsonResponse
    {
        return self::error('Validation Error', $validationErrors, $statusCode);
    }

    /**
     * Yetkilendirme hataları için yanıt döndürür.
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function unauthorized($message = 'Unauthorized', $statusCode = 401): JsonResponse
    {
        return self::error($message, [], $statusCode);
    }

    /**
     * İstisna yakalama ve yanıt döndürme
     *
     * @param \Exception $exception
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function exception($exception, $statusCode = 500): JsonResponse
    {
        // İstisna loglama
        Log::error('Exception occurred', [
            'exception' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ]);

        return response()->json([
            'status' => false,
            'icon' => 'error',
            'message' => 'An unexpected error occurred',
            'errors' => [
                'message' => $exception->getMessage(),
                'trace' => env('APP_DEBUG') ? $exception->getTrace() : null
            ]
        ], $statusCode);
    }
}
