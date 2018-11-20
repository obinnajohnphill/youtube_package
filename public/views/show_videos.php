
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
            <a class="navbar-brand" href="#">Search Result</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>
            <li><a href="/saved_videos">All Saved Videos</a></li>
        </ul>
    </div>
</nav>

<form action="/process" method="post">
<?php

session_start();
if(isset($_SESSION['videos']) && isset($_GET['number'])) {
    for ($i = 0; $i < $_GET['number']; $i++) {
        if (!empty($_SESSION['videos']['items'][$i]['id']['videoId'])){
            $videoId = $_SESSION['videos']['items'][$i]['id']['videoId'];
            $title = $_SESSION['videos'] ['items'][$i]['snippet']['title'];
            $description = $_SESSION['videos']['items'][$i]['snippet']['description'];
        ?>
        <div class="video-tile">
            <div class="videoDiv">
                <iframe id="iframe" style="width:100%;height:100%" src="//www.youtube.com/embed/<?php echo $videoId; ?>"
                        data-autoplay-src="//www.youtube.com/embed/<?php echo $videoId; ?>?autoplay=1"></iframe>
            </div>

            <input type="checkbox" name="videoId[]" value="<?php echo $videoId; ?>"><br>
            <input type="hidden" name="title[]" value="<?php echo $title; ?>">

            <div class="videoInfo">
                <div class="videoTitle"><b><?php echo $title; ?></b></div>
                <div class="videoDesc"><?php echo $description; ?></div>
            </div>
        </div>
        <?php
        }
    }
}
?>
<input type="submit" class="btn btn-primary" value="Submit">
</form>
</body>
</html>