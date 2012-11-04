<?php
include("DBMANAGER.php");
$login = $_POST["login"];
$pass = md5($_POST["pass"]);
if
(strlen($login) == '0') 
{
    header("Location: index.php?lgerror=2");
}

$db = new DBManager();
$db->open_dblink();
$dblink = $db->get_dblink();

$stmt = $dblink->prepare("SELECT UID, STATUS FROM users WHERE LOGIN=? AND PASS=?");
$stmt->bind_param('sd',$login,$pass);
$stmt->execute();
$stmt->bind_result($uid, $status);

if($stmt->fetch())
{
    if($status != 0)
    {
        session_start();
        $_SESSION["uid"]=$uid;
        $db->close_dblink();
        header("Location: index.php");
    }
    else
    {
        $db->close_dblink();
        header("Location: index.php?lgerror=3");
    }
}
else
{
    $db->close_dblink();
    header("Location: index.php?lgerror=1");
}
?>