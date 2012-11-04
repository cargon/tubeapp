<?php include("sessionctrl.php"); ?>
<div id="upload">
  
  <fieldset><legend>Upload de Videos</legend>
<table>
<form action="uploadhandler.php" method="post" enctype="multipart/form-data" class="form" id="upform">
  
<tr>
  <td> Titulo: </td>
  <td> <input name="titulo" type="text" class="tbox" id="uptitulo" size="40" />  </td>
</tr>
  
  
<tr>
  <td> Descri&ccedil;&atilde;o: </td>
  <td><textarea name="descricao" cols="40" rows="5" class="tarea" id="udesc"></textarea>
  </td>
</tr>


  <tr>  <input type="hidden" name="MAX_FILE_SIZE" value="15000000" />
    <td> Video para envio: </td>
    <td> <input type="file" name="upfile" id="upfile" size="40" /> </td>
    <?php  echo "<td> $_COOKIE[errupath] </td>"; ?></p>
    </tr>
  <tr>  
    <td> <input type="submit" name="upsubmit" id="upsubmit" value="Enviar Video" />    </td>
  </tr> 
</form>

</table>
</fieldset>
</div>
