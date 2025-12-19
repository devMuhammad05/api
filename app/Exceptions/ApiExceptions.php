<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ApiExceptions extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
        //
    }

    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request, Throwable $e): JsonResponse
    {
        if($request->expectsJson()) {
            if($e instanceof NotFoundHttpException) {
                return response()->json([
                    'message' => 'Resource not found'
                ]);
            }
        }

        return parent::render($request, $e);

    }
}
