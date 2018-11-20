<?php
/**
 * Created by PhpStorm.
 * User: obinnajohnphill
 * Date: 14/11/18
 * Time: 18:22
 */

namespace Obinna\Repositories;


use Obinna\YoutubeVideosModel;

class YoutubeVideosRepository extends YoutubeVideosModel
{

    public $data;
    public $duplicate;

    public function all(){
        $query = "SELECT * FROM  videos";
        $result = mysqli_query($this->connect(), $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $videoId[] = $row['video_id'];
                $title[] = $row['title'];
                $this->data = array("videoId"=>$videoId,"title"=>$title);
            }
        $this->close(); ## Close mysqli connection
        return  $this->data;
    }

    public function saveAll($video_id,$title){
        $payload = array();
        $query = "INSERT INTO videos (video_id, title)VALUES('$video_id','$title')";
        mysqli_query($this->connect(),$query);
        $this->close(); ## Close mysqli connection
        session_start();
        $payload ['msg'] = "Your video has been saved";
        $redirect = "../saved_videos?".http_build_query($payload);;
        header( "Location: $redirect" );
    }


    public function checkDuplicate($video_id,$title){
        $query  = "SELECT * FROM  videos WHERE video_id = '$video_id'";
        $result = mysqli_query($this->connect(), $query);
        if ($result->num_rows > 0) {
            $this->close();
            session_start();
            $data[] = $title;
            $payload ['msg'] = "Duplicate video exists in database";
            $payload ['title'] = $data;
            $redirect = "../?" . http_build_query($payload);;
            header("Location: $redirect");
        }else{
            $this->duplicate = true;
        }
        return $this->duplicate;
    }

    public function delete($video_id){
        $query  = "DELETE FROM videos WHERE video_id = '$video_id'";
        mysqli_query($this->connect(), $query);
        session_start();
        $payload ['delete-msg'] = "Videos deleted from database";
        $redirect = "../saved_videos?" . http_build_query($payload);;
        header("Location: $redirect");
    }

}