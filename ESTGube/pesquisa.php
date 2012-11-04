<?php

$lista = new VideoList();
$lista->setDblink($dblink);
$listavids = $lista->search($_GET['key']);



      
        
	$uservid = new Video();
        $uservid->setDblink($dblink);
        foreach ($listavids as $uvid)
        {
            $uservid->fetchVideoData($uvid);
            $uservid->getTitulo();
       ?>
<table>       
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