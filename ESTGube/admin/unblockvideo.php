<?php
include('sessionctrl.php');
include("DBMANAGER.php");
include('video.class.php');
$db = new DBManager();
$db->open_dblink();
$dblink=$db->get_dblink();

$video = new Video();
$video->setDblink($dblink);
$video->fetchVideoData($_GET['vid']);
$video->enable();

$db->close_dblink();
header('Location: index2.php?loc=4&vid='.$video->getVid());
?>