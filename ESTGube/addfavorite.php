<?php
include("sessionctrl.php");
include("DBMANAGER.php");
$db = new DBManager();
$db->open_dblink();
$dblink = $db->get_dblink();
$stmt = $dblink->prepare('INSERT INTO favoritos (vid,uid) values (?,?)');
$stmt->bind_param('dd',$_GET['vid'],$_SESSION['uid']);
$stmt->execute();
$stmt->close();
header("Location: index.php?loc=4&vid=$_GET[vid]");
?>