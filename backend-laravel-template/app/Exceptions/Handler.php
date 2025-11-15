<?php

namespace App\Exceptions;

use App\Utils\HttpResponseHelper;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // Handle API requests with clean error responses
        if ($request->is('api/*') || $request->expectsJson()) {
            if ($exception instanceof AuthenticationException) {
                return HttpResponseHelper::responseUnauthorized();
            }
            
            if ($exception instanceof ValidationException) {
                return HttpResponseHelper::responseBadRequest($exception->errors());
            }

            if ($exception instanceof ModelNotFoundException) {
                return HttpResponseHelper::responseNotFound('Resource not found');
            }

            if ($exception instanceof NotFoundHttpException) {
                return HttpResponseHelper::responseNotFound();
            }

            // For other exceptions in API, return clean response
            if (config('app.debug')) {
                // In debug mode, still show message but not full trace
                return response()->json([
                    'message' => $exception->getMessage(),
                    'code' => method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500,
                ], method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500);
            }

            // In production, show generic error
            return response()->json([
                'message' => 'Internal Server Error',
                'code' => 500,
            ], 500);
        }

        // For web requests, use default Laravel behavior
        return parent::render($request, $exception);
    }
}
