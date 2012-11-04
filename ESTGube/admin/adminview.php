<?php 

defined( 'EXECUTA' ) or die( 'Acesso Negado' );
include ('sessionctrl.php');
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
		<script type="text/javascript" src="../player/swfobject.js"></script>
		<div id="flashcontent" align="center"><p style="font-weight:bold;font-size:14pt;">Para ver este vídeo é necessário ter<br>no mínimo a versão 8 do Flash Player.</p><p><a href="http://www.adobe.com/flashplayer/">download</a>.</p></div>
		<script type="text/javascript">
			// <![CDATA[
			var so = new SWFObject("../player/flvplayer.swf?theFile=<?php echo "../videos/".$video->getFilename().".flv";?>&defaultImage=<?php echo "../videos/".$video->getFilename().".jpg";?>&theVolume=100&startPlayingOnload=yes&popUpHelp=no&bufferSeconds=2&videoSmoothing=yes","flvplayer","320","255","8","#000000");
			so.addParam("movie","../player/flvplayer.swf?theFile=<?php echo "../videos/".$video->getFilename().".flv";?>&defaultImage=<?php echo "../videos/".$video->getFilename().".jpg";?>&theVolume=100&startPlayingOnload=yes&popUpHelp=no&bufferSeconds=2&videoSmoothing=yes");
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
        <td><a href="apagarcomment.php?cid=<?php echo $comentario->getCid(); ?>">Apagar comentario</a></td>
        </tr>
        <tr>
        <td> <div class="separador"></div> </td>
        </tr>
        <?php }?>
      </table>
<br />    
    </div>
            
            
<!--###################################INFORMAÇAO DO VIDEO E UTILIZADOR################################################-->            
             <!-- -_______________________________________DADOS DO Utilizador__________________________________ -->
            <div class="midright">
               <table id="stats" width="400">
        		<tr >
            		<td  class="headbg">
           	    	<h3>Dados do Utilizador</h3>         	    
					</td>
    			</tr>
    			
    			<tr>
				<td>
					<strong>Login:</strong> <?php echo $utilizador->getLogin();?>
				</td>
				</tr>
    			
    			<tr>
				<td>
					<strong>Nome:</strong> <?php echo $utilizador->getNome();?>
				</td>
				</tr>
				
				<tr>
				<td>
					<strong>Nascido a:</strong> <?php echo $utilizador->getDatanasc();?>
				</td>
				</tr>
				
				<tr>
				<td>
					<strong>G&eacute;nero:</strong> <?php if($utilizador->getGenero() == 'M') echo 'Masculino'; else echo 'Feminino';?>
				</td>
				</tr>
				
				<tr>
				<td>
					<strong>User Level:</strong> <?php if($utilizador->getUsrlvl()=='S')echo 'Super'; else echo 'Normal';?>
				</td>
				</tr>
				
				<tr>
				<td>
					<strong>Data de Registo:</strong> <?php echo $utilizador->getDatacriado();?>
				</td>
				</tr>
				
				<tr>
				<td>
					<strong>Estado:</strong> <?php if($utilizador->getStatus()== 1) echo 'Activo'; else echo 'Inactivo';?>
				</td>
				</tr>
				<tr>
				<td>
						<a href="index2.php?loc=1&uid=<?php echo $utilizador->getUid(); ?>">Gerir Este utilizador</a>
				</td>
				</tr>
				
            
       </table>
       
       
       
       <!-- -_______________________________________DADOS DO VIDEO__________________________________ -->
              <p>&nbsp;</p>
            <table id="stats" width="400">
          		<tr >
            		<td  class="headbg">
					<h3>	Dados do Video  </h3> 
					</td>
    			</tr>
    			
    			<tr>
				<td>
					<strong>Titulo:</strong> <?php echo $video->getTitulo();?>
				</td>
				</tr>
				
				
            	<tr height="100">
            	<td valign="top">
            		<strong> Descri&ccedil;&atilde;o </strong> <br />
       		  		<?php echo $video->getDescricao();?> </td>
            	</tr>
            	<tr>
					<td>
					<strong>Data:</strong> <?php echo $video->getDatains();?>
					</td>
				</tr>
				
				<tr>
				<td>
					<strong>Nome do Ficheiro: </strong> <?php echo $video->getFilename();?>
				</td>
				</tr>
				<tr>
				<td>
					<strong>Estado do Video: </strong> <?php if($video->getStatus()==1)echo 'Disponivel'; else echo 'Bloqueado';?>
				</td>
				</tr>
				<tr>
				<td>
					<?php
						if($video->getStatus() == 1)
							echo '<a href="blockvideo.php?vid='.$video->getVid().'">Bloquear este video</a>';
						else
							echo '<a href="unblockvideo.php?vid='.$video->getVid().'">Desbloquear este video</a>';	
					
					?>
				</td>
				</tr>
				<tr>
				<td>
					<a href="apagarvideo.php?vid=<?php echo $video->getVid();?>" 
                    onclick="return confirm('Quer mesmo apagar este video?');">Apagar este video</a>
				</td>
				</tr>
       </table>
            
            </div>
