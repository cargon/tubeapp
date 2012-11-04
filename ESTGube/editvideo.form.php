<?php include("sessionctrl.php"); ?>
<?php 
$video = new Video();
$video->setDblink($dblink);
$video->fetchVideoData($_GET['vid']);

?>
<div id="upload">
  
  <fieldset><legend>Editar Video</legend>
<table>
<form action="editvideo.php" method="post" enctype="multipart/form-data" class="form" id="upform">
  
<tr>
  <td> Titulo: </td>
  <td> <input name="titulo" type="text" class="tbox" id="uptitulo" size="40" value="<?php echo $video->getTitulo(); ?>" />  </td>
</tr>
  
  
<tr>
  <td> Descri&ccedil;&atilde;o: </td>
  <td><textarea name="descricao" cols="40" rows="5" class="tarea" id="udesc"><?php echo $video->getDescricao(); ?></textarea>
  </td>
</tr>
  <tr>  
    <td> <input type="submit" name="upsubmit" id="upsubmit" value="Actualizar" />
          <input name="vid" type="hidden" value="<?php echo $_GET['vid'];?>"/>
  </td>
  </tr> 
</form>

</table>
</fieldset>
</div>
