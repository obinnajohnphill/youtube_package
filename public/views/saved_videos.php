
<!doctype html>
<html>
<head>
    <title>YouTube Search</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial;
            width: 100%;
            padding: 10px;
        }

        iframe {
            border: 0px;
        }
        .video-tile {
            display: inline-block;
            margin: 10px 10px 20px 10px;
        }

        .videoDiv {
            width: 250px;
            height: 150px;
            display: inline-block;
        }
        .videoTitle {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .videoDesc {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }
        .videoInfo {
            width: 250px;
        }
    </style>

</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">All Saved Videos</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>
        </ul>
    </div>
</nav>

<?php

include dirname(__FILE__).'/../../vendor/autoload.php';

use Obinna\Repositories\YoutubeVideosRepository;

if (!empty ($_GET['msg'])){
    $message = $_GET['msg'];
    echo '<div style="color:#4a8b15">' .$message.'</div>';
}

$videos = new YoutubeVideosRepository();
$showall = $videos->all();

for ($i = 0; $i < count($showall['videoId']); $i++) {
    $videoId = $showall['videoId'][$i];
    $title = $showall['title'][$i];
?>
<div class="video-tile">
    <div class="videoDiv">
        <iframe id="iframe" style="width:100%;height:100%" src="//www.youtube.com/embed/<?php echo $videoId; ?>"
                data-autoplay-src="//www.youtube.com/embed/<?php echo $videoId; ?>?autoplay=1"></iframe>
    </div>
    <div class="videoInfo">
        <div class="videoTitle"><b><?php echo $title; ?></b></div>
    </div>
</div>
<?php
}

?>
</body>
</html>