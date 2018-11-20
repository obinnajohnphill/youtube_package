<?php
/**
 * Created by PhpStorm.
 * User: obinnajohnphill
 * Date: 19/11/18
 * Time: 17:48
 */

namespace Obinna\RabbitMQ;

$directory = chop($_SERVER["DOCUMENT_ROOT"],'public');
require_once ("$directory./vendor/autoload.php");

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


class SendMessage
{
    public function __construct()
    {
      $this->receive();
    }

    public function receive(){
        $connection = new AMQPStreamConnection('localhost', 5672, 'obinna', 'obinna');
        $channel = $connection->channel();

        $channel->queue_declare('message', false, false, false, false);

        $msg = new AMQPMessage('Awesome, your videos successfully saved!');
        $channel->basic_publish($msg, '', 'message');
        $channel->close();
        $connection->close();
    }

}