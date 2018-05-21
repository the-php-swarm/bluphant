<?php

use Illuminate\Http\Request;
use SwooleTW\Http\Websocket\Facades\Websocket;

/*
|--------------------------------------------------------------------------
| Websocket Routes
|--------------------------------------------------------------------------
|
| Here is where you can register websocket events for your application.
|
*/

Websocket::on('connect', function ($websocket, Request $request) {
    // called while socket on connect
    $websocket->emit('message', 'welcome');
});

Websocket::on('disconnect', function ($websocket) {
    // called while socket on disconnect
});

/**
 * WebSocket format: socket.send("42[\"message\",\"test text\"]")
 * 
 * Format Reference:
 *     int -> Packet::$socketTypes
 *     int -> Packet::$engineTypes
 *     [
 *         string -> event
 *         string -> data
 *     ]
 */
Websocket::on('message', function ($websocket, $data) {
    $websocket->emit('message', $data);
});

// Websocket::on('test', 'ExampleController@method');