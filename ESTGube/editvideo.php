<?php
session_start();
include("DBMANAGER.php");
include("Video.class.php");
$db = new DBManager();
$db->open_dblink();
$dblink = $db->get_dblink();

$video = new Video();
$video->setDblink($dblink);
$video->fetchVideoData($_POST['vid']);

if($video->getUid() == $_SESSION['uid'])
{
    $video->setTitulo($_POST['titulo']);
    $video->setDescricao($_POST['descricao']);
    $video->updateVideo();
}
$db->close_dblink();
header("Location: index.php?loc=6");
?>