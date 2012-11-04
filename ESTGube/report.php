<?php
include("sessionctrl.php");
include("DBMANAGER.php");
include("report.class.php");
 $db=new DBManager();
 $db->open_dblink();
 $dblink = $db->get_dblink();
 
 $denuncia = new report();
 $denuncia->setDblink($dblink);
 $denuncia->setUid($_SESSION['uid']);
 $denuncia->setVid($_POST['vid']);
 $denuncia->setReport($_POST['report']);
 $denuncia->insert();
 
 $db->close_dblink();
 
header("Location: index.php?loc=4&vid=$_POST[vid]");
?>