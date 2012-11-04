<?php 

defined( 'EXECUTA' ) or die( 'Acesso Negado' );
session_start();


	$vidlist = new VideoList();
        $vidlist->setDblink($dblink);
		
        $video = new Video();
        $video->setDblink($dblink);
        
        $utilizador = new User();
        $utilizador->setDblink($dblink);
        
        
        $video->fetchVideoData($_GET['vid']);
        
        $utilizador->fetchUserData($video->getUid());
        
        $comentarios = $video->getComments();
        
        $comentario = new comment();
        $comentario->setDblink($dblink);
		
		
		
		if(!isset($_SESSION['view'.$_GET['vid']]))
		{
				$_SESSION['view'.$_GET['vid']] = 1;
				$video->setVezes($video->getVezes()+1);
				$video->updateVideo();
		}
?>




<!--###################################VIDEO E COMENTARIOS################################################-->
 <div class="midleft">
    
    
    <table id="video" width="350">
  <tr>
    	<td > <h2><?php echo $video->getTitulo(); ?> </h2></td>
    </tr>
    <tr>
    	<td height="255">
		<script type="text/javascript" src="player/swfobject.js"></script>
		<div id="flashcontent" align="center"><p style="font-weight:bold;font-size:14pt;">Para ver este vídeo é necessário ter<br>no mínimo a versão 8 do Flash Player.</p><p><a href="http://www.adobe.com/flashplayer/">download</a>.</p></div>
		<script type="text/javascript">
			// <![CDATA[
			var so = new SWFObject("player/flvplayer.swf?theFile=<?php echo "../videos/".$video->getFilename().".flv";?>&defaultImage=<?php echo "videos/".$video->getFilename().".jpg";?>&theVolume=100&startPlayingOnload=yes&popUpHelp=no&bufferSeconds=2&videoSmoothing=yes","flvplayer","320","255","8","#000000");
			so.addParam("movie","player/flvplayer.swf?theFile=<?php echo "../videos/".$video->getFilename().".flv";?>&defaultImage=<?php echo "videos/".$video->getFilename().".jpg";?>&theVolume=100&startPlayingOnload=yes&popUpHelp=no&bufferSeconds=2&videoSmoothing=yes");
			so.addParam("bgcolor","#000000");
			so.write("flashcontent");
			// ]]>
		</script>
        </td>
        </tr>
        
   </table>
       <br />
<table width="350" id="stats">
<tr >
        <td><strong>Avaliado em <?php echo $video->getRating();?> valores com  <?php echo $video->getVotos(); ?> votos       </strong></td>	
    </tr>
        <tr>
        <td><h3> Visto <?php echo $video->getVezes(); ?> vezes </h3></td>
        </tr>
      <?php if(!isset($_COOKIE['rate'.$_GET['vid']]))
	  {?>
<tr>
        <td>
            <strong>Classifique este video</strong></td> 
    </tr>
        <tr>
        
        <td colspan="2">
        <form action="rate.php" method="post" name="ratefrom" id="rateform">
          
            
          <div align="right">1
            <input type="radio" name="rating" id="radio1" value="1" /> 
            
            <input type="radio" name="rating" id="radio2" value="2" />
            
            <input type="radio" name="rating" id="radio3" value="3" />
            
            <input type="radio" name="rating" id="radio4" value="4" />
            
            <input type="radio" name="rating" id="radio5" value="5" />
            5
            <input type="hidden" name="vid" value="<?php echo $_GET['vid']; ?>" />
            <input class="button" type="submit" name="ratesubmit" id="ratesubmit" value="Classificar" />
            </div>
        </form>       	  </td>
        </tr>
        <tr>
        <td>
        <div class="separador"></div>
        </td>
        </tr>
        <?php if (isset($_SESSION['uid'])){?>
        <?php if(!$video->isfavorite($_SESSION['uid'])){?>
		<tr>
        
        	<td>
        		<a href="addfavorite.php?vid=<?php echo $video->getVid();?>">Adicionar aos favoritos
       	    </a></td>
        </tr>
        <?php } 
		if(!$video->isreported($_SESSION['uid']))
		{
		?>
        <tr>
          	<td>
        		<a href="index.php?loc=9&vid=<?php echo $video->getVid();?>">Denunciar este video
       	    </a></td>
        </tr>
        <?php }?>
      <?php }?>
       
        <?php }?>
        </table>
<br />
<br />
        <table width="350" id="comentarios">
<tr>
        	<td>
            	<h2>Comentarios</h2></td>
        </tr>
        
      <?php 
	  		if(!isset($comentarios[0])) echo "<tr><td> N&Atilde;o existem coment&aacute;rios para este video </td></tr>"; 
	  
	  	foreach($comentarios as $cid)
	  { $comentario->fetchComData($cid);
	  ?>  
        <tr>
        <td class="headbg">
	        <?php echo $comentario->getUser();?>
          </td>
        </tr>
        <tr>
        	<td>
            	<br />
              	<br />
        	  	<?php echo $comentario->getComentario();?>
                <br />
                <br />
            </td>
        </tr>
       
<tr>
        	<td> <strong>Comentado em: <?php echo $comentario->getDatacom();?> </strong></td>
        </tr>
        <tr>
        <td> <div class="separador"></div> </td>
        </tr>
        <?php }?>
      </table>
<br />
        <?php 
		if(isset($_SESSION['uid']))
        { ?>
        <table width="350">
       	  <tr>
            <td>
            	<h2>Comente este video</h2>
            </td>
            </tr>
            <tr>
            	<td>
                	<form action="comentar.php" method="post" name="comentar">
                      <input type="hidden"  name="vid" value="<?php echo $_GET[vid];?>" />
                      <textarea name="comentario" cols="40" rows="10" class="ta" id="tacomment"></textarea>
                      <input name="comsubmit" type="submit" value="Comentar" />
                    </form>
                </td>
             
            
            </tr>
        
        
        </table>
        <?php
		}
		else
		echo "Para comentar este video inicie sess&atilde;o";
		?>
		
    </div>
            
            
<!--###################################INFORMAÇAO DO VIDEO E UTILIZADOR################################################-->            
            
            <div class="midright">
            <table id="stats" width="400">
		  <tr>
            	<td width="65" rowspan="2">
               	  <strong>Utilizador:</strong> </td>
              <td width="279">
               <h3> <?php  echo $utilizador->getLogin();  ?>             </h3>
            </td>
            </tr>
            <tr>
            	<td>
           	  <strong>Activo desde:</strong><?php echo $utilizador->getDatacriado();   ?></td>
            </tr>
            </table>
            
            <p>&nbsp;</p>
            <table id="stats" width="400">
            <tr >
            	<td  class="headbg"><strong>
           	    Descri&ccedil;&atilde;o           	    </strong></td>
    		</tr>
            <tr height="100">
            	<td valign="top">
       		  <?php echo $video->getDescricao();?> </td>
            </tr>
       </table>
            
            <p>&nbsp;</p>
            <p></p>
            <p></p>
            <h2> Outros videos deste utilizador </h2>
            <table class="listavideos" width="400">
    <?php
      
        
		$uservid = new Video();
        $uservid->setDblink($dblink);
       
		$uvids = $utilizador->getUserVideos(0,$utilizador->countVideos());
		
        foreach ($uvids as $uvid)
        {
            $uservid->fetchVideoData($uvid);
            $uservid->getTitulo();
       ?>
<tr>
             <td width="140" rowspan="3">
             <a href="index.php?loc=4&vid=<?php echo $uservid->getVid();?>"><img src="videos/<?php echo $uservid->getFilename();?>.jpg" alt="thumb" width="140" height="100" /></a>
      </td>
      <td class="headbg" height="5" width="260" valign="top">
              <label> <?php echo $uservid->getTitulo();?> </label>
      </td>
          </tr>
            <tr>
                <td valign="top"  bordercolor="#0000FF">
                   <label></label> 
                   <?php echo $uservid->getDescricao();?>              </td>
          </tr>
            <tr>
                <td valign="top" bordercolor="#0000FF">
              <label> Inserido a: </label><?php echo $uservid->getDatains();?>                </td>
          </tr> 
          <tr height="10">
          </tr>       
          	
   <?php
        }
    ?>
    
    </table>
            </div>