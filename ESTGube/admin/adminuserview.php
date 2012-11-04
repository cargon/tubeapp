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
		$utilizador->fetchUserData($_GET['uid']);
		    
		
        $comentario = new comment();
        $comentario->setDblink($dblink);
		$comentarios = $utilizador->getusercoms(0,$utilizador->getcommentcount());
		
?>




<!--###################################VIDEO E COMENTARIOS################################################-->
 <div class="midleft">
    
    <br />
    <br />
    <br />
    <br />
     <table id="stats" width="350">
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
	   		<?php if($utilizador->getStatus()==1) 
			   		echo '<a href="disableuser.php?uid='.$_GET['uid'].'">Desactivar utilizador</a>';
			   else
			   		echo '<a href="enableuser.php?uid='.$_GET['uid'].'">Activar utilizador</a>';
			?>
	   
	   		</td>
		</tr>		
            <tr>
	   		<td>
	   		<?php if($utilizador->getUsrlvl()=='S') 
			   		echo '<a href="makenormal.php?uid='.$_GET['uid'].'">Transformar em utilizador NORMAL</a>';
			   else
			   		echo '<a href="makesuper.php?uid='.$_GET['uid'].'">Transformar em SUPERUTILIZADOR</a>';
			?>
	   
	   		</td>
		</tr>
       </table>
       
       <br />

        <table width="350" id="comentarios">
<tr>
        	<td>
            	<h2>Comentarios deste utilizador</h2></td>
        </tr>
        
      <?php 
	  		if(!isset($comentarios[0])) echo "<tr><td> N&Atilde;o existem coment&aacute;rios deste utilizador </td></tr>"; 
	  
	  	foreach($comentarios as $cid)
	  { $comentario->fetchComData($cid);
	  	$video->fetchVideoData($comentario->getVid());
	  ?>  
        <tr>
        <td class="headbg">
	        <?php echo 'No Video: <a href="index2.php?loc=4&vid='.$comentario->getVid().'" >'.$video->getTitulo().'</a>' ;?>
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
            
            
<!--############################################################################-->            
             <!-- -___________________________________________________________________ -->
            <div class="midright">
           <!-- -_______________________________________videos deste utilizadorO__________________________________ -->
                 
          	<h2> Videos deste utilizador</h2> <br />
       <table class="listavideos" width="400">
    <?php
      
        
		$uservid = new Video();
        $uservid->setDblink($dblink);
       
		
		
		$uvids = $utilizador->getUserVideos(0,$utilizador->countVideos());
		if(empty($uvids))echo '<h3> N&atilde;o existem videos deste utilizador </h3>';
        foreach ($uvids as $uvid)
        {
            $uservid->fetchVideoData($uvid);
            $uservid->getTitulo();
       ?>
<tr>
             <td width="140" rowspan="3">
             <a href="index2.php?loc=4&vid=<?php echo $uservid->getVid();?>"><img src="../videos/<?php echo $uservid->getFilename();?>.jpg" alt="thumb" width="140" height="100" /></a>
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
				</tr>
       </table>
            
            </div>
