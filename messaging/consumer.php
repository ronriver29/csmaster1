<?php

require_once __DIR__.'/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

try {
    $connection = null;
    do {
        try {
            echo "checking connectivity..\n";
            $connection = new AMQPStreamConnection(
                'messaging', // this is based on the #links tag on the docker-compose file :)
                5672, // default rabbitmq port
                'mquser', // default rabbitmq user I set, you could change this on the docker-compose file
                'password' // default rabbitmq password I set
            );
        } catch (PhpAmqpLib\Exception\AMQPIOException $AMQPIOException) {
            // retry in 5secs
            sleep(5);
        }
    } while ($connection === null || !$connection->isConnected());
    echo "CONNECTION ESTABLISHED!!\n";

    $channel = $connection->channel();

    $channel->queue_declare('deferred-process');

    $callback = function ($message) {
        // this is where you do your long running process :)
        echo 'Received '. $message->body. "\n";
    };

    $channel->basic_consume('deferred-process', '', false, true, false, false, $callback);

    while ($channel->is_consuming()) {
        $channel->wait();
    }

    $channel->close();
    $connection->close();
} catch (\Exception $e) {
    echo "Error: {$e->getMessage()}";
}