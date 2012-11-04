<?php defined( 'EXECUTA' ) or die( 'Acesso Negado' ); ?>
<div class="midleft" id="newest">
    
    <h2>Videos Mais Recentes</h2>
     <table class="listavideos" width="350">
    <?php
        $vidlist = new VideoList();
        $vidlist->setDblink($dblink);
		
        $video = new Video();
        $video->setDblink($dblink);
		
        $vistos = $vidlist->getMaisRecentes(0,3);
        foreach ($vistos as $vid)
        {
            $video->fetchVideoData($vid);
            $video->getTitulo();
       ?>
<tr>
             <td width="140" rowspan="3">
             <a href="index.php?loc=4&vid=<?php echo $video->getVid();?>"><img src="videos/<?php echo $video->getFilename();?>.jpg" alt="thumb" width="140" height="100" /></a>
      </td>
       <td  class="headbg" height="5" width="260" valign="top" >
              <label> <?php echo $video->getTitulo();?> </label>
              </td>
          </tr>
            <tr>
                <td valign="top"  bordercolor="#0000FF">
                   <label> Inserido por: </label> <?php echo $video->getUser();?>              </td>
          </tr>
            <tr>
                <td valign="top" bordercolor="#0000FF">
              <label> Inserido a: </label><?php echo $video->getDatains();?>                </td>
          </tr> 
          <tr height="10">
          </tr>       
          	
   <?php
        }
    ?>
    
    </table>
    </div>


    <div class="midright" id="vistos">
	 <h2> Videos mais vistos </h2>
        <table class="listavideos" width="350">
    <?php
        $vidlist = new VideoList();
        $vidlist->setDblink($dblink);
        
		$video = new Video();
        $video->setDblink($dblink);
        
		$vistos = $vidlist->getMaisVistos(0,3);
        foreach ($vistos as $vid)
        {
            $video->fetchVideoData($vid);
            $video->getTitulo();
       ?>
<tr>
             <td width="140" rowspan="3">
             <a href="index.php?loc=4&vid=<?php echo $video->getVid();?>"><img src="videos/<?php echo $video->getFilename();?>.jpg" alt="thumb" width="140" height="100" /></a>
      </td>
       <td class="headbg" height="5" width="260" valign="top">
              <label> <?php echo $video->getTitulo();?> </label>
              </td>
          </tr>
            <tr>
                <td valign="top"  bordercolor="#0000FF">
                   <label> Inserido por: </label> <?php echo $video->getUser();?>              </td>
          </tr>
            <tr>
                <td valign="top" bordercolor="#0000FF">
              <label> Inserido a: </label><?php echo $video->getDatains();?>                </td>
          </tr> 
          <tr height="10">
          </tr>       
          	
   <?php
        }
    ?>
    
    </table>
</div>
