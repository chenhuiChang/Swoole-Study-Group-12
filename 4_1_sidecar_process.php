<?php

$server = new Swoole\Server('127.0.0.1', 9501, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);
$NODE_PATH = 'YOUR_NODE_PATH'; // for example, /Users/xxx/.nvm/versions/node/v14.16.1/bin/node

$process = new Swoole\Process(function ($process) use ($server, $NODE_PATH) {
    $socket = $process->exportSocket();
    while (true) {
        $msg = $socket->recv();
        if ($msg === 'node') {
            $process->exec($NODE_PATH, ['bench/node-http.js']);
        }
        if ($msg === 'go') {
            $process->exec('/bin/sh', ['bench/go-http']);
        }
        if ($msg === 'tmux') {
            $process->exec('/usr/local/bin/tmux', ['split-window']);
        }
    }
}, false, 2, 1);

$server->addProcess($process);

$server->on('Packet', function ($serv, $data, $clientInfo) use ($process) {
    $process->write(trim($data));
    $serv->sendTo($clientInfo['address'], $clientInfo['port'], "Swoole: $data");
});

$server->start();