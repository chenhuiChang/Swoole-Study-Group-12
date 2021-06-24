<?php

$server = new Swoole\HTTP\Server("127.0.0.1", 3000);
$server->on("start", function (Swoole\Http\Server $server) {
    echo "Swoole http server is started at http://127.0.0.1:3000\n";
});

$server->on("request", function (Swoole\Http\Request $request, Swoole\Http\Response $response) {
    $response->header("Content-Type", "application/json");
    $request_method = $request->server['request_method'];
    $content = $request->getContent();
    $message = sprintf("hello user #%s in %s", rand(1, 9999), $request_method);
    echo $message . "\n";
    echo $content . "\n";
    $response->write(json_encode(['message' => $message]));
    $response->end();
});
$server->start();
