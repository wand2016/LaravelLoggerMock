<?php

use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

/** @var RouteRegistrar $router */

$router->get('/', function () {
    Log::notice('アクセス', ['datetime' => Carbon::now()]);
    Log::notice('なにか別のログ');

    return view('welcome');
});
