<?php

namespace App\Exceptions;

use App\Services\JsonResponseService;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    protected $jsonResponseService;

    public function __construct(Container $container, JsonResponseService $jsonResponseService)
    {
        $this->jsonResponseService = $jsonResponseService;
        parent::__construct($container);
    }

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     *
     * @return void
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \ReflectionException
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->jsonResponseService->fail([
                'errors' => ['failed' => 'HTTP_METHOD_NOT_ALLOWED'],
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        }

        if ($exception instanceof AuthenticationException) {
            return $this->jsonResponseService->fail([
                'errors' => ['failed' => 'HTTP_UNAUTHORIZED'],
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof ModelNotFoundException) {
            return $this->jsonResponseService->fail([
                'errors' => ['failed' => 'HTTP_NOT_FOUND'],
            ], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->jsonResponseService->fail([
                'errors' => ['failed' => 'HTTP_NOT_FOUND'],
            ], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof UnauthorizedException) {
            return $this->jsonResponseService->fail([
                'errors' => ['failed' => 'HTTP_FORBIDDEN'],
            ], Response::HTTP_FORBIDDEN);
        }

        if ($exception instanceof HttpResponseException) {
            return parent::render($request, $exception);
        }

        return $this->jsonResponseService->fail([
            'message'   => [
                'failed' => json_decode($exception->getMessage()) != null ?
                    json_decode($exception->getMessage()) : $exception->getMessage(),
            ],
            'exception' => (new \ReflectionClass($exception))->getShortName(),
            'file'      => $exception->getFile(),
        ], Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
