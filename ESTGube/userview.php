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
        	<td><?php echo $comentario->getComentario();?>
       	  <br/>
       	    </td>
        </tr>
       
<tr>
        	<td> <strong>Comentado em: <?php echo $comentario->getDatacom();?> </strong></td>
        </tr>
        <tr>
        <td><a href="apagarcomment.php?cid=<?php echo $comentario->getCid(); ?>" onclick="return confirm(\'Quer mesmo apagar este comentário?\');">Apagar comentario</a></td>
        </tr>
        <tr>
        <td> <div class="separador"></div> </td>
        </tr>
        <?php }?>
      </table>
<br />    
    </div>
            
            
<!--###################################INFORMAÇAO DO VIDEO E UTILIZADOR################################################-->            
            
            <div class="midright">
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
            
            </div>
