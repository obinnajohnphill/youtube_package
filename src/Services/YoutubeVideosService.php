<?php
/**
 * Created by PhpStorm.
 * User: obinnajohnphill
 * Date: 14/11/18
 * Time: 18:24
 */

namespace Obinna\Services;


use Obinna\RabbitMQ\SendMessage;
use Obinna\Repositories\YoutubeVideosRepository;
use Obinna\YoutubeVideosModel;


class YoutubeVideosService extends YoutubeVideosRepository
{

   public $video_id;
   public $title;

   public function __construct($videId,$title)
   {
       $connect = new YoutubeVideosModel ();
       parent::__construct($connect);

       $this->video_id = $videId;
       $this->title = $title;
       if ($this->title != "delete"){
           $this->saveVideos();
       }else{
           $this->deleteVideos();
       }

   }

   public function saveVideos(){
       for ($i = 0; $i < count($this->video_id); $i++) {
           $isduplicate = $this->checkDuplicate($this->video_id[$i],$this->title[$i]);
           if ($isduplicate == true){
               new SendMessage();
              $this->saveAll($this->video_id[$i],$this->title[$i]);
           }
       }
   }

   public function deleteVideos(){
       for ($i = 0; $i < count($this->video_id); $i++) {
           $this->delete($this->video_id[$i]);
       }
   }

}