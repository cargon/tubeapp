<?php
session_start();
session_destroy();
setcookie('manter',false,time()-1);
header("Location: index.php");
?>