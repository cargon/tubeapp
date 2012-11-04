<?php include("sessionctrl.php"); ?>

<fieldset><legend>Denunciar Video</legend>
<form action="report.php" method="post">
    <h4>Escreva
    o motivo da sua denuncia<br>
    e a razão de achar este video impróprio. </h4>
  <p>
  <textarea name="report" cols="30" rows="4" onchange="if(this.length==0)alert('tem de inserir uma descrição');"></textarea>
  </p>
  <p>
  	<input type="hidden" name="vid" value="<?php echo $_GET['vid']; ?>" >
    <input name="reportsubmit" type="submit" value="Denunciar" onclick="return alert(\'Este Video Foi Denunciado\');">
    </p>
</form>
</fieldset>