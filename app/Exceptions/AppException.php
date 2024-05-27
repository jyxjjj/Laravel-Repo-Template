<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class AppException extends Exception
{
    public function __construct(
        protected ErrorCodes $errorCode = ErrorCodes::PROCESSING_FAILURE,
        ?string              $message = null,
        ?Throwable           $previous = null
    )
    {
        parent::__construct($message ?? ErrorCodes::getMsg($errorCode), $errorCode->value, $previous);
    }

    public function getErrorCode(): ErrorCodes
    {
        return $this->errorCode;
    }
}
