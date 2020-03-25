<?php
require_once './vendor/autoload.php';

$http = new Swoole\HTTP\Server("0.0.0.0", 80);

$http->on('start', function ($server) {
    echo "http server is started at http://127.0.0.1:80\n";
});

$http->on('request', function ($request, $response) use ($twig, $static) {
    $router = new \BruteforceMovable\Router();
    $response->header("Content-Type", "text/html");
    $response->end($router->process($request));
});

$http->start();