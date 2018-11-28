<?php
/**
 * Created by PhpStorm.
 * User: obinnajohnphill
 * Date: 14/11/18
 * Time: 18:22
 */

namespace Obinna\Repositories;

use PDO;
use PDOException;
use Obinna\YoutubeVideosModel;
use Memcached;


class YoutubeVideosRepository
{
    public $data;
    public $duplicate;
    public $conn;
    public $memcached;
    public $memcached_key = "select";

    public function __construct(YoutubeVideosModel $connect)
    {
        try{
            $this->conn = new PDO('mysql:host='.$connect->host().';dbname='.$connect->db().'', $connect->user(), $connect->pass());
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
            echo "Database connection failed: " . $e->getMessage();
        }
        $this->memcached = new Memcached();
        $this->memcached ->addServer($connect->memcached_server(),$connect->memcached_server_port());
    }


    public function all(){
        try{
            ## Get result from memcached if data exists in cache
            $data = file_get_contents("cache.txt");
            $file = unserialize( $data );
            $cached = $this->memcached->get("select");
            if ($this->memcached->getResultCode() !== Memcached::RES_NOTFOUND) {
                if ($file == $cached){
                    echo "Cached Data:  ";
                    return  $cached;
                }
            }
            ## Run query to get data if no longer in cache
            $statement  = $this->conn->prepare("SELECT * FROM  videos");
            $statement ->execute();
            while ( $row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                $videoId[] = $row['video_id'];
                $title[] = $row['title'];
                $this->data = array("videoId"=>$videoId,"title"=>$title);
            }
            if ($file != $cached){
                $this->memcached->set("select", $this->data, 60*60); ## Sets data into cache
            }
            file_put_contents("cache.txt",serialize($this->data));
            return  $this->data;

        }
        catch(PDOException $e)
        {
            echo "Select all failed: " . $e->getMessage();
        }
    }


    public function saveAll($video_id,$title)
    {
        $payload = array();
        try {
            $statement = $this->conn->prepare("INSERT INTO videos (video_id, title) VALUES ('$video_id','$title')");
            $statement->execute();
            $statement = null;
            $this->memcached->flush();
        }
        catch(PDOException $e)
        {
            echo "Insert failed: " . $e->getMessage();
        }
        session_start();
        $payload ['msg'] = "Your video has been saved";
        $redirect = "../saved_videos?".http_build_query($payload);;
        header( "Location: $redirect" );
    }


    public function checkDuplicate($video_id,$title){
        try {
            $statement = $this->conn->prepare("SELECT * FROM  videos WHERE video_id = '$video_id'");
            $statement->execute();
            $number_of_rows = $statement->fetchColumn();
            if ($number_of_rows > 0) {
                session_start();
                $data[] = $title;
                $payload ['msg'] = "Duplicate video exists in database";
                $payload ['title'] = $data;
                $redirect = "../?" . http_build_query($payload);;
                header("Location: $redirect");
            } else {
                $this->duplicate = true;
            }
            return $this->duplicate;
        }
        catch(PDOException $e)
        {
            echo "Check num-rows failed: " . $e->getMessage();
        }
    }


    public function delete($video_id){
        try{
            $statement = $this->conn->prepare("DELETE FROM videos WHERE video_id = '$video_id'");
            $statement->execute();
            $statement = null;
            $this->memcached->flush();
        }
        catch(PDOException $e)
        {
        echo "Delete failed: " . $e->getMessage();
        }
        session_start();
        $payload ['delete-msg'] = "Videos deleted from database";
        $redirect = "../saved_videos?" . http_build_query($payload);;
        header("Location: $redirect");
    }

}