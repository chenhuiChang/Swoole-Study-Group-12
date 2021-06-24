<?php

$server = new Swoole\Http\Server("0.0.0.0", 9501, SWOOLE_BASE);
$server->set([
    'enable_static_handler' => true, 'http_autoindex' => false,
    'document_root' => realpath(__DIR__ . '/Calculator/'),
]);
$server->on('request', function ($req, $resp) {
    // Swoole\Http\Response->redirect(string $url, int $http_code = 302): void
    $resp->redirect('/index.html', 302);
});
$server->start();
