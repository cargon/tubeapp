<?php
include('sessionctrl.php');
include("DBMANAGER.php");
include('report.class.php');
$db = new DBManager();
$db->open_dblink();
$dblink=$db->get_dblink();

$report = new report();
$report->setDblink($dblink);
$report->fetch($_GET['rid']);
$report->tratar();



$db->close_dblink();
header('Location: index2.php?loc=3');
?>