<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Exceptions\MissingScopeException;
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

    // public function render($request, Throwable $exception)
    // {
    //     if ($exception instanceof MissingScopeException) {
    //         return response()->json([
    //             'errors' => [
    //                 'status' => 401,
    //                 'message' => 'Unauthenticated.'
    //             ]
    //         ], 401);
    //     }

    //     $e = $this->prepareException($exception);
    //     if ($e instanceof HttpResponseException) {
    //         return $e->getResponse();
    //     } elseif ($e instanceof AuthenticationException) {
    //         return $this->unauthenticated($request, $e);
    //     } elseif ($e instanceof ValidationException) {
    //         return $this->convertExceptionToResponse($e, $request);
    //     }

    //     return $this->prepareResponse($request, $e);
    // }

    // protected function unauthenticated($request, AuthenticationException $exception)
    // {
    //     return response()->json([
    //         'errors' => [
    //             'status' => 401,
    //             'message' => 'Unauthenticated.'
    //         ]
    //     ], 401);
    // }
}
