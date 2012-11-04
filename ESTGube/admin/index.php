<?php 
	session_start();
        define( 'EXECUTA', 1 );
        include ("VideoList.class.php");
        include ("Video.class.php");
        include ("DBMANAGER.php");
		include ("user.class.php");
		include ("comment.class.php");
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

  <div class="top" id="header"><a href="index.php"><img src="assets/banner.PNG" alt="ESTGube" width="795" height="135" /></a></div>




  <div class="top" id="search">
 
  </div>

  <div class="middlecontainer">
  <br/>
  <br/>
	<?php
////////////////////////////////////////// MEIO ///////////////////////////////////////////////////////////////
				
				include("login.form.php");
				
	?>
    <br/>
	<br/>
    </div>
	<p id="clear"><br/>
  </p>
  <div class="bottom" id="footer">   Grain WebDesign|Madeira Powa|FTW|Copyright: ROFL<br />
    Funciona melhor no browser Firefox
      <?php $db->close_dblink(); ?>
    </p>
    </div>
</div>
</body>
</html>
