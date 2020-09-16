<?php

// this is a sample of a publisher script

require_once __DIR__.'/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection(
    'messaging', // this is based on the #links tag on the docker-compose file :)
    5672, // default rabbitmq port
    'mquser', // default rabbitmq user I set, you could change this on the docker-compose file
    'password' // default rabbitmq password I set
);
$channel = $connection->channel();

$message = new AMQPMessage(
    json_encode([
        'id' => 1, // id that could identify what should be processed
        // ... you could also add more details that would be needed on the processing side
    ]),
    [
        'content_type' => 'application/json', // this is dependent on the payload type you would like to send, for me i like to send around data in a json format :)
    ]
);

$channel->basic_publish($message, '', 'deferred-process');

$channel->close();
$connection->close();