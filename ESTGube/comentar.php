<?php
session_start();
include ("DBMANAGER.php");
include ("comment.class.php");
$db = new DBManager();
$db->open_dblink();
$dblink = $db->get_dblink();

$comentario = new Comment();
$comentario->setDblink($dblink);
$comentario->inserirValores($_POST["vid"],$_SESSION["uid"],$_POST["comentario"]);
$comentario->inserirComentario();
$db->close_dblink();

header("Location: index.php?loc=4&vid=$_POST[vid]");
?>