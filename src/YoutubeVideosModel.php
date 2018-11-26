<?php
/**
 * Created by PhpStorm.
 * User: obinnajohnphill
 * Date: 14/11/18
 * Time: 18:24
 */

namespace Obinna;

use Dotenv;

class YoutubeVideosModel
{
    protected $host;
    protected $user;
    protected $pass;
    protected $db;
    protected $memcached_server;
    protected $memcached_server_port;

    public function __construct(){
        $directory = chop($_SERVER["DOCUMENT_ROOT"],'public');
        $dotenv = new Dotenv\Dotenv($directory.'/');
        $dotenv->load();
        $this->host =  $_ENV['DB_HOST'];
        $this->user =  $_ENV['DB_USER'];
        $this->pass =  $_ENV['DB_PWD'];
        $this->db =  $_ENV['DB_NAME'];
        $this->memcached_server = $_ENV['MEMCACHED_SERVER'];
        $this->memcached_server_port = $_ENV['MEMCACHED_SERVER_PORT'];
     }

    public function host(){
        return $this->host;
    }

    public function user(){
        return $this->user;
    }

    public function pass(){
        return $this->pass;
    }

    public function db(){
        return $this->db;
    }

    public function memcached_server(){
        return $this->memcached_server;
    }

    public function memcached_server_port(){
        return $this->memcached_server_port;
    }

}