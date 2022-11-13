<?php

namespace App\Services\External;

use App\Exceptions\ApplicationErrorException;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

/**
 * Базовый класс для сервисов, которые предназначены для обращения к сторонним json API
 */
abstract class ExternalJsonApiService
{
    abstract public function getApiDomain();

    /**
     * Вызывается только тогда, когда ответ от API пришел с клиенткской или серверной ошибкой
     * @param \Illuminate\Http\Client\Response $response
     * @return void
     * @throws ApplicationErrorException
     */
    public function handleErrors(\Illuminate\Http\Client\Response $response): void
    {
        $message = $response['message'] ?? $response['msg'] ?? '';
        throw new ApplicationErrorException($message);
    }

    public function formatResponse(array $response): array
    {
        return $response;
    }

    public function sendGet($action, array $params = [], bool $withErrors = false): array
    {
        $endpoint = $this->getApiDomain() . $action;
        $response = Http::get($endpoint, $params);

        if ($response->failed()) {
            if ($response->status() == Response::HTTP_NOT_FOUND) {
                throw new ApplicationErrorException('Not found endpoint ' . $endpoint);
            }

            $this->handleErrors($response);
        }

        return $this->formatResponse($response->json());
    }
}
