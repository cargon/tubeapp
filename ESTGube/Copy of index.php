<?php 
	session_start();
	if( $_COOKIE["login"]== 'true' || isset($_SESSION["uid"]) )
		$logged = 1;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ESTGube</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body>
<div class="container" id="contentor">
  <div class="top" id="session">
  	
    <table width="800">
   
    <tr>
     <?php if($logged==1){ ?>
    	<td> <a href="logout.php">logout</a> | <a href="index.php?loc=insv">Inserir Videos</a></td>
<?php } else {  ?>
          
          <form action="login.php" method="post" name="login">
  		<td> <label>Nome de Utilizador: </label></td>
  		<td> <input name="login" type="text" class="textb" id="lglogin" size="25" maxlength="20" /> </td>
  		<td><label>Palavra-Passe:</label> </td>
        <td> <input name="pass" type="password" class="textb" id="lgpass" size="25" maxlength="20" /> </td>
        <td> <input name="btlogin" type="submit" class="button" id="lgsubmit" value="Entrar" /> </td>
        <td> <label> lembrar-se de mim </label> </td>
        <td> <input name="manter" type="checkbox" class="checkbox" id="lgmanter" value="manter" /> </td>
        </form>
     <?php }	?>
    </tr>
   
    
    
    
    <tr>
    <td colspan="5">
		<?php 
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
    	<?php if($logged != 1)echo "<a href=\"index.php?loc=nu\">Registe-se </a>"; ?>
        </td>
    <td>&nbsp;</td></tr>
    
  	
    </table>
   
  </div>

  <div class="top" id="header"><img src="assets/banner.PNG" alt="ESTGube" width="800" height="135" /></div>

  <div class="top" id="search">
  <table>
  	<tr>
    	<td>
    <form id="form1" name="form1" method="post" action="">
      <input type="text" name="pesquisa" id="pesquisa" size="50" />
      <input type="submit" name="psubmit" id="psubmit" value="Pesquisar" />
    </form>
    	</td>
    </tr>
    </table>
  </div>

  <div class="middlecontainer">
	<?php
		$local = $_GET["loc"];
		switch($local)
		{
			case 'insv':
			{
				include("uploadform.php");
				break;
			}
			case 'nu':
			{
				include("newuser.form.php");
				break;
			}
			
			default:
			{
				//include("front.php");
				break;
			}
		}
	
	?>
    <div class="midleft" id="video">
    
    
    <table width="350">
    <tr>
    	<td > TITULO </td>
    </tr>
    <tr>
    	<td height="255">
		<script type="text/javascript" src="player/swfobject.js"></script>
		<div id="flashcontent" align="center"><p style="font-weight:bold;font-size:14pt;">Para ver este vídeo é necessário ter<br>no mínimo a versão 8 do Flash Player.</p><p><a href="http://www.adobe.com/flashplayer/">download</a>.</p></div>
		<script type="text/javascript">
			// <![CDATA[
			var so = new SWFObject("player/flvplayer.swf?theFile=<?php echo "../videos/$filename.flv";?>&defaultImage=<?php echo "videos/$filename.jpg";?>&theVolume=100&startPlayingOnload=no&popUpHelp=no&bufferSeconds=2&videoSmoothing=yes","flvplayer","320","255","8","#000000");
			so.addParam("movie","player/flvplayer.swf?theFile=<?php echo "../videos/$filename.flv";?>&defaultImage=<?php echo "videos/$filename.jpg";?>&theVolume=100&startPlayingOnload=no&popUpHelp=no&bufferSeconds=2&videoSmoothing=yes");
			so.addParam("bgcolor","#000000");
			so.write("flashcontent");
			// ]]>
		</script>        </td>
        </tr>
        <tr>
        <td>
        <form action="rate.php" method="post" name="ratefrom" id="rateform">
        Classifique este video: 
          1
          <input type="radio" name="rating" id="radio1" value="1" />
        	2
        	<input type="radio" name="rating" id="radio2" value="2" />
            3
            <input type="radio" name="rating" id="radio3" value="3" />
            4
            <input type="radio" name="rating" id="radio4" value="4" />
            5
            <input type="radio" name="rating" id="radio5" value="5" />
            <br />
            adicionar aos favoritos 
            <input type="submit" name="ratesubmit" id="ratesubmit" value="Classificar" />
            <input type="hidden" name="vid" value="<?php echo $vid; ?>"  />
        </form>
        	</td>
        </tr>
        </table>
        <br />
        <table width="350">
    <tr>
        	<td>
            	Comentarios
            </td>
        </tr>
        
        <tr>
        <td>
	        user
        </td>
        </tr>
        <tr>
        	<td>
            comment
            </td>
        </tr>
      </table>
        <br />
        <table width="350">
       	  <tr>
            <td>
            	Comente este video
            </td>
            </tr>
            <tr>
            	<td>
                	<form action="comentar.php" method="post" name="comentar">
                      <textarea name="comentario" cols="50" rows="10" class="ta" id="tacomment"></textarea>
                      <input name="comsubmit" type="submit" value="Comentar" />
                    </form>
                </td>
             
            
            </tr>
        
        
        </table>
        
    </div>
            
            
            
            
            <div class="midright">
            <table width="400">
			<tr>
            	<td width="65" rowspan="2">
                	Utilizador:            
                 </td>
                <td width="279">
                 username               
                 </td>
            </tr>
            <tr>
            	<td>
                	Activo desde: 
                data</td>
            </tr>
            </table>
            
            <br />
            
            
      <table width="400">
            <tr>
            	<td >
            	DESCRICAO                </td>
            </tr>
            <tr>
            	<td height="98">
            		descricao var            	</td>
            </tr>
            </table>
            
            <table width="400">
            <tr>
            <td colspan="2">
            Outros videos deste utilizador
            </td>
            </tr>
            
            <tr>
            <td rowspan="2">
            pic
            </td>
            <td>
            titulo
            </td>
            </tr>
            <tr>
              <td>descricao</td>
            </tr>
            </table>
            </div>

  </div>


<p id="clear"> </p>
  <div class="bottom" id="footer">Content for  class "bottom" id "footer" Goes Here</div>
</div>
</body>
</html>
