<?php

namespace App\Exceptions;

use App\Helpers\Common\JResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(): void
    {
    }

    public function render($request, $e): \Illuminate\Http\Response|JsonResponse|Response
    {
        if ($request->is('api/*') || $request->wantsJson()) {
            if ($e instanceof NotFoundHttpException) {
                return JResponse::error('Page Not Found', [], Response::HTTP_NOT_FOUND);
            }
            if ($e instanceof ModelNotFoundException) {
                $modelName = last(explode('\\', $e->getModel()));
                return JResponse::error($modelName.' Not Found', [], Response::HTTP_NOT_FOUND);
            }
            if ($e instanceof HttpException) {
                return JResponse::error($e->getMessage(), [], $e->getStatusCode());
            }
        }

        return parent::render($request, $e);
    }
}
