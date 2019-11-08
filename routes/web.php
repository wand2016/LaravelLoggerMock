<?php

use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

/** @var RouteRegistrar $router */

$router->get('/', function () {
    Log::notice('アクセス', ['datetime' => Carbon::now()]);
    return view('welcome');
});
