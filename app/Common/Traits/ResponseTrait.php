<?php

namespace App\Common\Traits;

use App\Exceptions\ErrorCodes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ResponseTrait
{
    private array $header = [];

    final protected function fail(ErrorCodes $code = ErrorCodes::UNKNOWN_ERROR, ?string $message = null, array $data = []): JsonResponse
    {
        return $this->success($data, $message ?? ErrorCodes::getMsg($code), $code);
    }

    final protected function success(array $data = [], string $msg = 'success', ErrorCodes $code = ErrorCodes::SUCCESS): JsonResponse
    {
        return $this->value($data, $msg, $code);
    }

    final protected function value(mixed $data, string $msg = 'success', ErrorCodes $code = ErrorCodes::SUCCESS): JsonResponse
    {
        $this->setHeader('Content-Type', 'application/json; charset=UTF-8');
        return response()->json([
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ], 200, $this->header, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    final protected function setHeader(string $headerKey, string $headerValue): void
    {
        $this->header = [$headerKey => $headerValue] + $this->header;
    }

    final protected function plain(string $str): Response
    {
        $this->setHeader('Content-Type', 'text/plain; charset=UTF-8');
        return $this->response($str);
    }

    final protected function response(string $str): Response
    {
        return response($str, 200, $this->header);
    }
}
