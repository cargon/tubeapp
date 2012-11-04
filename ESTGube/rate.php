<?php

include ("DBMANAGER.php");
$db = new DBManager();
$db->open_dblink();
$dblink = $db->get_dblink();

$stmt = $dblink->prepare("UPDATE ratings SET rating=rating+?, votos=votos+1 WHERE vid=?");
$stmt->bind_param('dd', $_POST['rating'],$_POST['vid']);
$stmt->execute();
$stmt->close();
$db->close_dblink();
setcookie('rate'.$_POST['vid'], 1, time() + 3600*24*5 );
header("Location: index.php?loc=4&vid=$_POST[vid]");
?>