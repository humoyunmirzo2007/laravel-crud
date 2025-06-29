<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    protected $levels = [];

    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->renderable(function (AuthenticationException $e, $request) {
            return response()->json([
                'message' => __('messages.unauthenticated'),
            ], 401);
        });

        $this->renderable(function (ModelNotFoundException $e, $request) {
            return response()->json([
                'message' => __('messages.model_not_found'),
            ], 404);
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json([
                'message' => __('messages.not_found'),
            ], 404);
        });
    }
}
