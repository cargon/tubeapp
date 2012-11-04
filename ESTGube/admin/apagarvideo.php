<?php
session_start();
include('sessionctrl.php');
include("VideoList.class.php");
include("Video.class.php");
include("DBMANAGER.php");
$db = new DBManager();
$db->open_dblink();
$dblink=$db->get_dblink();

$video = new Video();
$video->setDblink($dblink);
$video->fetchVideoData($_GET['vid']);

$listavids = new VideoList();
$listavids->setDblink($dblink);


    $listavids->deleteVideo($video);





$db->close_dblink();
header("Location: index2.php?loc=6");
?>