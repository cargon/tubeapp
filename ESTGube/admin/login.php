<?php
include("DBMANAGER.php");
$login = $_POST["login"];
$pass = md5($_POST["pass"]);

;
if( strlen($login) == 0 ) 
{
    header("Location: index.php?lgerror=2");
}

$db = new DBManager();
$db->open_dblink();
$dblink = $db->get_dblink();

$stmt = $dblink->prepare("SELECT UID,usrlvl, STATUS FROM users WHERE LOGIN=? AND PASS=?");
$stmt->bind_param('sd',$login,$pass);
$stmt->execute();
$stmt->bind_result($uid, $usrlvl, $status);

if($stmt->fetch())
{
    if($status != 0 && $usrlvl == 'S')
    {
        session_start();
        $_SESSION["uid"]=$uid;
        $_SESSION['usrlvl']=$usrlvl;
        $db->close_dblink();
        header("Location: index2.php");
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