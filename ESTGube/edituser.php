<?php
session_start();
include "user.class.php";
include "DBMANAGER.php";


$user = new User();
$db = new DBManager();
$db->open_dblink();
$dblink = $db->get_dblink();
$user->setDblink($dblink);
$user->fetchUserData($_SESSION['uid']);
$datanasc = $_POST["nuano"]."-".$_POST["numes"]."-".$_POST["nudia"];
$user->setNome($_POST["nome"]);
$user->setDatanasc($datanasc);
$user->setGenero($_POST["genero"]);
$user->setEmail($_POST["email"]);


if(!empty($_POST['pass']))
    if($_POST['pass'] == $_POST['pass2'])
        $user->setPass(md5($_POST["pass"]));



$user->updateUser();
$db->close_dblink();

header("Location: index.php");



?>