<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Spiral\Goridge;

$relay = Goridge\Relay::create('tcp://127.0.0.1:6001');

$rpc = new Goridge\RPC\RPC($relay);

//or, using factory:
// $tcpRPC = new Goridge\RPC\RPC($relay);
// $unixRPC = new Goridge\RPC\RPC(Goridge\Relay::create('unix:///tmp/rpc.sock'));
// $streamRPC = new Goridge\RPC\RPC(Goridge\Relay::create('pipes://stdin:stdout'));

echo $rpc->call("App.Hi", "Antony");
