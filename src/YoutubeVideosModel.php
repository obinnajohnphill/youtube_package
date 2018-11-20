<?php

namespace Obinna;

class YoutubeVideosModel {

    public $host = '192.168.10.10';
    public $user = 'homestead';
    public $pass = 'secret';
    public $db = 'youtube_video';
    public $conn;

    function connect() {
        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (!$con) {
            die('Could not connect to database!');
        }else {
            $this->conn = $con;
        }
        return $this->conn;
    }

    function close() {
       return  mysqli_close($this->conn);
    }
}