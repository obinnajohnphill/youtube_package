<?php
/**
 * Created by PhpStorm.
 * User: obinnajohnphill
 * Date: 19/11/18
 * Time: 17:48
 */

namespace Obinna\RabbitMQ;

require_once dirname(__FILE__).'../../../../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

class ReceiveMessage
{
  public function __construct()
  {

  }

  public function receive(){
      $connection = new AMQPStreamConnection('192.168.10.10', 5672, 'obinna', 'obinna');
      $channel = $connection->channel();

      $channel->queue_declare('hello', false, false, false, false);

      echo " [*] Waiting for messages. To exit press CTRL+C\n";

      $callback = function ($msg) {
          echo ' [x] Received ', $msg->body, "\n";
      };

      $channel->basic_consume('hello', '', false, true, false, false, $callback);

      while (count($channel->callbacks)) {
          $channel->wait();
      }

      $channel->close();
      $connection->close();
  }

}