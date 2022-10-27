<?php

namespace App\Helpers\Common;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JResponse
{
    /**
     * @param null $data Данные ответа
     * @param int $status HTTP cтатус ответа
     * @return JsonResponse
     */
    public static function success($data = null, int $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json($data, $status);
    }

    /**
     * @param null $data Данные ответа
     * @return JsonResponse
     */
    public static function create($data = null): JsonResponse
    {
        return response()->json($data, Response::HTTP_CREATED);
    }

    /**
     * @param string $message Основное сообщение об ошибке
     * @param array $errors Дополнительные параметры ошибки
     * @param int $status HTTP cтатус ошибки
     * @return JsonResponse
     */
    public static function error(string $message = '', array $errors = [], int $status = Response::HTTP_BAD_REQUEST, ): JsonResponse
    {
        $data = [
            'message' => $message,
            'errors' => $errors
        ];
        return response()->json($data, $status);
    }
}
