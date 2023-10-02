<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Spiral\Goridge\Relay;
use Spiral\Goridge\RPC\Codec\MsgpackCodec;
use Spiral\Goridge\RPC\RPC;

$relay = Relay::create('tcp://127.0.0.1:6001');

$rpc = new RPC($relay);
$rpc = $rpc->withCodec(new MsgpackCodec());

//or, using factory:
// $tcpRPC = new Goridge\RPC\RPC($relay);
// $unixRPC = new Goridge\RPC\RPC(Goridge\Relay::create('unix:///tmp/rpc.sock'));
// $streamRPC = new Goridge\RPC\RPC(Goridge\Relay::create('pipes://stdin:stdout'));

echo $rpc->call("App.Hi", "Antony"); echo "\n";

$file = file_get_contents(__DIR__ . '/main.php');

echo $rpc->call("App.CountBytes", $file); echo "\n";
