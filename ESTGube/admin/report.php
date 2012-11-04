<?php 
$report = new report();
$report->setDblink($dblink);
$report->fetch($_GET['rid']);
?>
<br/>
<br/>
<table id="logindiv" width="350">
<tr>
<td>
<strong>Denuncia efectuada pelo utilizador</strong> <a href="index2.php?loc=7&uid=<?php echo $report->getUid(); ?>"><?php echo $report->fetchuser(); ?> </a>
</td>
</tr>
<tr>
<td>
<strong>Em relação ao video:</strong> <a href="index2.php?loc=4&vid=<?php echo $report->getVid(); ?>"> <?php echo $report->fetchtitulo(); ?> </a>
</td>
</tr>
<tr>
<td>
<strong> Descrição: </strong>
</td>
</tr>
<tr height="50">
<td>
<?php echo $report->getReport(); ?>
</td>
</tr>
<tr>
<td>
<?php if($report->getTratado()==0){?>
  <a href="tratar.php?rid=<?php echo $report->getRid(); ?>">Marcar como tratada </a>
  <?php }else echo 'Esta denuncia ja foi tratada'; ?>
  
  </td>
</tr>
</table>