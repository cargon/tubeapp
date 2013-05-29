<?php 
	define( 'EXECUTA', 1 );
        define( 'LOGGEDIN', 1);
        define('LOGGEDOUT', 0);
        $logged = LOGGEDOUT;

        session_start();
	
        if( /*$_COOKIE["login"]== 'true' ||*/ isset($_SESSION["uid"]) )
		$logged = LOGGEDIN;
    
        
        
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
  <div class="top" id="session">
  	
    <table width="800">
   
    <tr>
     <?php
//////////////////////////////////////////// AUTENTICAÇAO ////////////////////////////////
     if(isset($logged))
         if($logged==LOGGEDIN){ ?>
    	<td> <a href="logout.php">| logout</a> | <a href="index.php?loc=1">Inserir Videos</a>| <a href="index.php?loc=5">Alterar os meus dados</a> | <a href="index.php?loc=6">Os meus Videos</a> | <a href="index.php?loc=10">Os meus favoritos</a> |</td>
<?php } else {  ?>
          
          <form action="login.php" method="post" name="login">
  		<td> <label>Nome de Utilizador: </label></td>
  		<td> <input name="login" type="text" class="textb" id="lglogin" size="25" maxlength="20" /> </td>
  		<td><label>Palavra-Passe:</label> </td>
        <td> <input name="pass" type="password" class="textb" id="lgpass" size="25" maxlength="20" /> </td>
        <td> <input name="btlogin" type="submit" class="button" id="lgsubmit" value="Entrar" /> </td>
        <td> <input name="manter" type="hidden" class="checkbox" id="lgmanter" value="manter" /> </td>
        </form>
     <?php }	?>
    </tr>
   
    
    
    
    <tr>
    <td colspan="5">
		<?php 
			if(isset($_GET["lgerror"]))
                        switch($_GET["lgerror"])
			{
				case 1:
					{
						echo 'Palavra-passe e\ou nome de utilizador invalidos';
						break;
					}
				case 2:
					{
						echo 'Por favor preencha os campos de autenticação';
						break;
					}
				case 3:
					{
						echo 'A sua conta está desactivada';
						break;
					}
				default:
					{
						break;
					}
			}
		?>
    </td>
    <td colspan="2">
    	<?php  
                    if($logged != LOGGEDIN)echo "<a href=\"index.php?loc=2\">Registe-se </a>"; ?>
        </td>
    <td>&nbsp;</td></tr>
    
  	
    </table>
   
  </div>

  <div class="top" id="header"><a href="index.php"><img src="assets/banner.PNG" alt="ESTGube" width="795" height="135" /></a></div>




  <div class="top" id="search">
  <table width="800">
  	<tr>
    	<td width="705">
    <form id="searchform" name="searchform" method="get" action="index.php">
      <input type="hidden" name="loc" value="3" />
      <input type="text" name="key" id="key" size="50" />
      <input type="submit" name="psubmit" id="psubmit" value="Pesquisar" />
    </form>
    	</td>
    </tr>
    </table>
  </div>

  <div class="middlecontainer">
	<?php
////////////////////////////////////////// MEIO ///////////////////////////////////////////////////////////////
		$local = isset($_GET["loc"])? $_GET["loc"] : 'default';
		switch($local)
		{
			case '1':
			{
				include("uploadform.php");
				break;
			}
			case '2':
			{
				include("newuser.form.php");
				break;
			}
            case '3':
            {
             	include("pesquisa.php");
                break;
            }
			case '4':
			{
			    include("view.php");
                break;
			}
			case '5':
			{
				include("edituser.form.php");
                break;
			}
			case '6':
			{
				include("tabelavideos.php");
				break;
			}
			case '7':
            {
                include("editvideo.form.php");
				break;
            }
            case '8':
            {
                include("userview.php");
				break;
            }
			case '9':
			{
				include("report.form.php");
				break;
			}
			case '10':
			{
				include("showfavorites.php");
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
