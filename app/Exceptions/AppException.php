<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class AppException extends Exception
{
    public function __construct(
        public ErrorCodes $errorCode = ErrorCodes::PROCESSING_FAILURE {
            get {
                return $this->errorCode;
            }
        },
        ?string           $message = null,
        ?Throwable        $previous = null
    )
    {
        parent::__construct($message ?? ErrorCodes::getMsg($errorCode), $errorCode->value, $previous);
    }

}
