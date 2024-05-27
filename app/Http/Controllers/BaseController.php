<?php

namespace App\Http\Controllers;

use App\Common\Traits\ResponseTrait;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use ValidatesRequests, ResponseTrait;
}
