<?php

$server = new Swoole\HTTP\Server("127.0.0.1", 9501);

$server->on("start", function (Swoole\Http\Server $server) {
    echo "Swoole http server is started at http://127.0.0.1:9501" . PHP_EOL;
});

$server->on("request", function (Swoole\Http\Request $request, Swoole\Http\Response $response) {
    var_dump($request);
    $response->header("Content-Type", "text/plain");
    echo "request" . PHP_EOL;
    $response->end("Hello Swoole. #" . rand(1000, 9999));
});
$server->start();