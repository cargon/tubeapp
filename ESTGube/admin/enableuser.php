<?php
include('sessionctrl.php');
include("DBMANAGER.php");
include('user.class.php');
$db = new DBManager();
$db->open_dblink();
$dblink=$db->get_dblink();
$user = new User();
$user->setDblink($dblink);
$user->fetchUserData($_GET['uid']);
$user->enable();
$db->close_dblink();
header('Location: index2.php?loc=7&uid='.$user->getUid());
?>