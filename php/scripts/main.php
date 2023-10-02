<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Spiral\Goridge;

$rpc = new Goridge\RPC\RPC(
    Goridge\Relay::create('tcp://127.0.0.1:6001')
);

//or, using factory:
$tcpRPC = new Goridge\RPC\RPC(Goridge\Relay::create('tcp://127.0.0.1:6001'));
$unixRPC = new Goridge\RPC\RPC(Goridge\Relay::create('unix:///tmp/rpc.sock'));
$streamRPC = new Goridge\RPC\RPC(Goridge\Relay::create('pipes://stdin:stdout'));

echo $rpc->call("App.Hi", "Antony");
