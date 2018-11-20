<?php
/**
 * Created by PhpStorm.
 * User: obinnajohnphill
 * Date: 14/11/18
 * Time: 19:30
 */


include dirname(__FILE__).'/../../vendor/autoload.php';

use Obinna\Controllers\YoutubeVideosController;

use Obinna\Services\YoutubeVideosService;

## Process selected-to-save videos
if (!empty($_POST["videoId"])){
    $save = new YoutubeVideosService($_POST["videoId"],$_POST["title"]);
}


## Process the search items videos
if (isset($_POST["searchterm"]) AND isset($_POST["number"]) )
{

    $searchItem =  htmlspecialchars($_POST["searchterm"]);
    $number = htmlspecialchars($_POST["number"]);

    if (empty($searchItem) OR empty($number))
    {
        echo "<h1>Error!!</h1>";
        echo "<h3>Please enter a search term then try again</h3>";
        echo "<h5><a href='/'>Go back</a></h5>";
        die();
    }else{
        $passer = new YoutubeVideosController($searchItem, $number);

    }

}



