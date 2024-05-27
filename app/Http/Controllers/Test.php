<?php /** @noinspection PhpUnusedPrivateMethodInspection,PhpUnusedParameterInspection */

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use ReflectionClass;
use ReflectionMethod;
use Throwable;

class Test extends BaseController
{
    public function test(Request $request): Response|JsonResponse|View|string
    {
        $method = $request->query('method');
        $methods = (new ReflectionClass($this))->getMethods(ReflectionMethod::IS_PRIVATE);
        $methods = array_filter($methods, fn($v) => $v->class === $this::class);
        $methods = array_filter($methods, fn($v) => $v->name !== 'test');
        $methods = array_column($methods, 'name');
        if (in_array($method, $methods)) {
            $data = [];
            try {
                $data = $this->{$method}($request) ?? [];
            } catch (Throwable $e) {
                dump($e);
            } finally {
                return is_array($data) ? $this->success($data) : (is_string($data) ? $this->success([], $data) : $data);
            }
        } else {
            dd('PARAM_INVALID');
        }
    }
}
