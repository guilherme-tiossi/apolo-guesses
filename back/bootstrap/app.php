<?php

use App\Models\ErrorLog;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: '',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->throttleApi('api', redis: true);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->is('game') || $request->is('game/*'),
        );

        $exceptions->renderable(function (Throwable $exception) {
            $statusCode = $exception instanceof HttpExceptionInterface
                ? $exception->getStatusCode()
                : 500;

            if ($statusCode !== 500) {
                return null;
            }

            $errorKey = (string) Str::uuid();

            try {
                ErrorLog::create([
                    'id' => $errorKey,
                    'exception' => mb_substr((string) $exception, 0, 500),
                ]);
            } catch (Throwable) {
                // A failure while logging must not expose the original exception.
            }

            return response()->json([
                'message' => 'Ops, um erro interno aconteceu',
                'error_key' => $errorKey,
            ], 500);
        });
    })->create();
