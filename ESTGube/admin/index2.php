<?php 
	include('sessionctrl.php');
        define( 'EXECUTA', 1 );
        include ("VideoList.class.php");
        include ("Video.class.php");
        include ("DBMANAGER.php");
		include ("user.class.php");
		include ("comment.class.php");
		include ('reportlist.class.php');
		include ('report.class.php');
		include ('userHandler.class.php');
        $db = new DBManager();
        $db->open_dblink();
        $dblink = $db->get_dblink();
        
        ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ESTGube</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body class="corpo">
<div class="container" id="contentor">
  <div>
   <H1 align="center" style="color:#FF0000"> ADMINISTRAÇÃO </H1>
  </div>

  <div class="top" id="header"><a href="index2.php"><img src="assets/banner.PNG" alt="ESTGube" width="795" height="135" /></a></div>




  <div class="top" id="adminmenu">
    | <a href="index2.php?loc=5&qtd=10">Videos</a> | <a href="index2.php?loc=2">Utilizadores</a> | <a href="index2.php?loc=3">Denuncias</a> | <a href="logout.php">Logout</a> |</div>

  <div class="middlecontainer">
	<?php
////////////////////////////////////////// MEIO ///////////////////////////////////////////////////////////////
		$local = $_GET["loc"];
		switch($local)
		{
			case '1':
			{
				include("adminuserview.php");
				break;
			}
			case '2':
			{
				include("tabelausers.php");
				break;
			}
            case '3':
            {
             	include("tabeladenuncias.php");
                break;
            }
			case '4':
			{
			    include("adminview.php");
                break;
			}
			case '5':
			{
				include("tabelavideos.php");
                break;
			}
			case '6':
			{
				include("report.php");
				break;
			}
			case '7':
            {
                include("adminuserview.php");
				break;
            }
            case '8':
            {
                include("userview.php");
				break;
            }
			default:
			{
				include("front.php");
				break;
			}
		}
	
	?>
    </div>
	<p id="clear"><br/>
  </p>
  <div class="bottom" id="footer"> Grain WebDesign|Madeira Powa|FTW|Copyright: ROFL<br />
    Funciona melhor no browser Firefox
    <?php $db->close_dblink(); ?>
  </div>
</div>
</body>
</html>
