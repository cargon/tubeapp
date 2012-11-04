<?php
session_start();
include("sessionctrl.php");
include("DBMANAGER.php");
include("comment.class.php");
include("Video.class.php");

$db=new DBManager();
$db->open_dblink();
$dblink = $db->get_dblink();

$comentario=new Comment();
$comentario->setDblink($dblink);

$video = new video();
$video->setDblink($dblink);



$comentario->fetchComData($_GET['cid']);
$video->fetchVideoData($comentario->getVid());

if($video->getUid() == $_SESSION['uid'])
        $comentario->apagarComentario();    

$db->close_dblink();

header("Location: index.php?loc=8&vid=".$video->getVid());
?>