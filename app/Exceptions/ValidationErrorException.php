<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

/**
 * Исключение для ошибок валидации полей (422 http статус)
 * Всегда отображаются пользователю
 */
class ValidationErrorException extends BusinessErrorException
{
    public function __construct(array $errors = [])
    {
        if (empty($errors))
            throw new ApplicationErrorException('Errors cannot be empty');

        $message = reset($errors);
        parent::__construct($message, $errors, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
