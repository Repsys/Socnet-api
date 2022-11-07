<?php

namespace App\Exceptions;

use App\Helpers\Common\JResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

/**
 * Исключение для внутренних ошибок приложения (500е http статусы)
 * Отображаются пользователю только в режиме отладки
 */
class ApplicationErrorException extends Exception
{
    public function __construct(string $message = '', int $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        if ($code < 500 || $code > 599)
            throw new ApplicationErrorException('Invalid 5XX status', Response::HTTP_INTERNAL_SERVER_ERROR);
        parent::__construct($message, $code);
    }

    /**
     * Render the exception.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        if (App::hasDebugModeEnabled()) {
            return JResponse::errorFromException($this);
        }
        return JResponse::error('Internal Server Error', [], $this->getCode());
    }
}
