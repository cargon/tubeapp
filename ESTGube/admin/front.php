<?php defined( 'EXECUTA' ) or die( 'Acesso Negado' ); ?>
<div class="midleft" id="newest">
    
    <h2>Denuncias por resolver</h2>
     <table class="listavideos" width="350">
    <?php
        $vidlist = new VideoList();
        $vidlist->setDblink($dblink);
		
        $video = new Video();
        $video->setDblink($dblink);
		
		$report = new report();
		$report->setDblink($dblink);
		$reportlist = new reportlist();
		$reportlist->setDblink($dblink);
		
		
		$user = new User();
		$user->setDblink($dblink);
		
        $ridlist = $reportlist->fetchlastreports(0,5);
		if(!empty($ridlist))
        foreach ($ridlist as $rid)
        {
			$report->fetch($rid);
            $video->fetchVideoData($report->getVid());
            $video->getTitulo();
			$user->fetchUserData($report->getUid());
       ?>
<tr>
             <td width="140" rowspan="3">
             <a href="index2.php?loc=4&vid=<?php echo $video->getVid();?>"><img src="../videos/<?php echo $video->getFilename();?>.jpg" alt="thumb" width="140" height="100" /></a>
      </td>
       <td  class="headbg" height="5" width="260" valign="top" >
              <label> <?php echo $video->getTitulo();?> </label>
              </td>
          </tr>
            <tr>
                <td valign="top"  bordercolor="#0000FF">
                   <label> Denunciado por: </label> <a href="index2.php?loc=1&uid=<?php echo $user->getUid();?>"><?php echo $user->getLogin();?> </a>             </td>
          </tr>
            <tr>
                <td valign="top" bordercolor="#0000FF">
              <label> Denuncia: </label><?php echo $report->getReport();?>                </td>
          </tr> 
          <tr height="10">
          </tr>       
          	
   <?php
        } else echo "<h3> N&atilde;o existem denuncias </h3>"
    ?>
    
    </table>
    </div>


    <div class="midright" id="vistos">
	 <h2>Videos mais recentes</h2>
        <table class="listavideos" width="350">
    <?php
        $vidlist = new VideoList();
        $vidlist->setDblink($dblink);
        
		$video = new Video();
        $video->setDblink($dblink);
        
		$vistos = $vidlist->getMaisRecentes(0,5);
        foreach ($vistos as $vid)
        {
            $video->fetchVideoData($vid);
            $video->getTitulo();
       ?>
<tr>
             <td width="140" rowspan="3">
             <a href="index2.php?loc=4&vid=<?php echo $video->getVid();?>"><img src="../videos/<?php echo $video->getFilename();?>.jpg" alt="thumb" width="140" height="100" /></a>
      </td>
       <td class="headbg" height="5" width="260" valign="top">
              <label> <?php echo $video->getTitulo();?> </label>
              </td>
          </tr>
            <tr>
                <td valign="top"  bordercolor="#0000FF">
                   <label> Inserido por: </label><a href="index2.php?loc=1&uid=<?php echo $video->getUid();?>"> <?php echo $video->getUser();?></a>              </td>
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
