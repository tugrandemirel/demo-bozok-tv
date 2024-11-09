<?php

namespace App\Helpers\Response;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\MessageBag;

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
     * @param array|string $errors
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
            'errors' => count($errors) > 0 ? self::formatValidationErrors($errors) : [] // Hata mesajlarını düz formatta döndür
        ], $statusCode);
    }

    /**
     * İstek yapısı doğrulama hataları için yanıt döndürür.
     *
     * @param array|string $validationErrors
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function validationError($validationErrors, $statusCode = 422): JsonResponse
    {
        return self::error('Validation Error', $validationErrors, $statusCode);
    }

    /**
     * Doğrulama hatalarını <ul><li></li></ul> yapısına dönüştürür.
     *
     * @param array $validationErrors
     * @return string
     */
    /**
     * Doğrulama hatalarını düz bir formatta döndürür.
     *
     * @param array|string $validationErrors
     * @return array
     */
    private static function formatValidationErrors($validationErrors): array
    {
        $errors = [];

        if (is_string($validationErrors)) {
            // Tek bir string hata mesajı varsa, onu doğrudan diziye ekleyelim
            $errors[] = $validationErrors;
        } elseif (is_array($validationErrors)) {
            foreach ($validationErrors as $fieldErrors) {
                if (is_array($fieldErrors)) {
                    foreach ($fieldErrors as $error) {
                        $errors[] = $error;
                    }
                } else {
                    $errors[] = $fieldErrors;
                }
            }
        } elseif($validationErrors instanceof MessageBag) {
            $fieldErrors = $validationErrors->toArray();
            foreach ($fieldErrors as $error) {
                $errors[] = $error;
            }
        }

        return $errors;
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
