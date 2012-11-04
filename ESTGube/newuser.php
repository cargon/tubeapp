<?php

include "userHandler.class.php";
include "user.class.php";
include "DBMANAGER.php";




$datanasc = $_POST["nuano"]."-".$_POST["numes"]."-".$_POST["nudia"];
$user = new User();
$user->insertData($_POST["nome"],$datanasc,$_POST["genero"],$_POST["email"],$_POST["login"],md5($_POST["pass"]));
$db = new DBManager();
$db->open_dblink();
$dblink = $db->get_dblink();

$userh = new userHandler();

$userh->setDblink($dblink);
$res=$userh->insertUser($user);
$db->close_dblink();

if($res)header("Location: index.php");



?>