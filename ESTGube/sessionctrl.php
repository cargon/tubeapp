<?php
session_start();
if(!(isset($_SESSION["uid"]) || $_COOKIE["loggedin"]=='true') )
{
    header('Location: index.php');
}
?>