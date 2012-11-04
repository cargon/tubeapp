<?php
session_start();
if(!(isset($_SESSION["uid"]) && $_SESSION["usrlvl"]=='S') )
{
    header('Location: index.php');
}
?>