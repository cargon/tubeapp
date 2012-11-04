<?php
session_start();
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

if($video->getUid() == $_SESSION['uid'])
    $listavids->deleteVideo($video);





$db->close_dblink();
header("Location: index.php?loc=6");
?>