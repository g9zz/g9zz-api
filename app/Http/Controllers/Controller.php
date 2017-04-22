<?php

namespace App\Http\Controllers;

use App\Traits\G9zzLog;
use App\Traits\Respond;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,Respond,G9zzLog;

    public function __construct()
    {
    }

}
