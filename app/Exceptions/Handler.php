<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
        ValidatorException::class,
        DataNullException::class,
        CodeException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return mixed
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidatorException) {
            $code = $exception->getCode();
            if ($code == 0) $code = 400000000;
            $content = config('validation.message.'.$code);
            return \Response::json(['message' => $content,'code' => $code,'data' => (object)null],200);
        }

        if ($exception instanceof DataNullException) {
            $code = $exception->getCode();
            if ($code == 0) $code = 400000001;
            $content = config('validation.message.'.$code);
            return \Response::json(['message' => $content,'code' => $code,'data' => (object)null],200);
        }

        if ($exception instanceof codeException) {
            $code = $exception->getCode();
            $content = config('validation.message.'.$code);
            return \Response::json(['message' => $content,'code' => $code,'data' => (object)null],200);
        }


        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
