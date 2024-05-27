<?php

namespace App\Exceptions;

use App\Common\Traits\ResponseTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Console\Exception\CommandNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ResponseTrait;

    protected $dontReport = [
        CommandNotFoundException::class,
    ];
    protected $dontFlash = [
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
        })->stop();
        $this->renderable(function (Throwable $e) {
            switch (get_class($e)) {
                case AppException::class:
                    return $this->fail($e->getErrorCode(), $e->getMessage());
                default:
                    ErrorCodes::log($e);
                    return $this->fail();
            }
        });
    }
}
