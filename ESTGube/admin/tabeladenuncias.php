<?php
session_start();
include ('sessionctrl.php');

$report = new report();
$report->setDblink($dblink);

$reportlist = new reportlist();
$reportlist->setDblink($dblink);



if($_GET['qtd']== 'todas')
	$qtd=$reportlist->reportcount();
else
	if(empty($_GET['qtd'])|| !is_numeric($_GET['qtd']))
		$qtd=10;
	else
		$qtd=$_GET['qtd'];
	
$user = new User();
$user->setDblink($dblink);

$rows = array();
$headings = array('Video','Utilizador','Data da denuncia');
?>
<br/>
<div>Mostrar: | 
<a href="index2.php?loc=3&stat=1&qtd=<?php echo $_GET['qtd']; ?>">Denuncias tratadas</a> |
<a href="index2.php?loc=3&stat=0&qtd=<?php echo $_GET['qtd']; ?>"> Denuncias por tratar</a> |
</div>
<br/>
<div> 
Mostrar as 
<a href="index2.php?loc=3&stat=<?php echo $_GET['stat']; ?>&qtd=10">10</a>
<a href="index2.php?loc=3&stat=<?php echo $_GET['stat']; ?>&qtd=20">20</a>
<a href="index2.php?loc=3&stat=<?php echo $_GET['stat']; ?>&qtd=30">30</a> primeiras denuncias
| <a href="index2.php?loc=3&stat=<?php echo $_GET['stat']; ?>&qtd=todas">Mostrar todas as denuncias</a> 
</div>

<div id="search">


</div>
<?php

$op=$_GET['stat'];
switch($op)
{
case '0':                // ############################## MAIS COMENTADOS
{
    $uids = $reportlist->fetchlastreports(0,$qtd);
        break;
}
case '1':     // ############################## MAIS VISTOS
	{
    $uids = $reportlist->fetchtratados(0,$qtd);
        break;
	}
    
    default:			// ############################## POR DEFEITO
    {
    $uids = $reportlist->fetchlastreports(0,$qtd);
     break;
	}
}
if(empty($uids))
	echo "<h2>N&atilde;o existem denuncias</h2>";
else
foreach($uids as $rid)
    {    
        $report->fetch($rid);
            $rows[] = array(
			'<a href="index2.php?loc=4&vid='.$report->getVid().'" >'.$report->fetchtitulo().'</a>',
            '<a href="index2.php?loc=7&uid='.$report->getUid().'" >'.$report->fetchuser().'</a>',
			$report->getDatarep(),
			'<a href="index2.php?loc=6&rid='.$rid.'" >Detalhes</a>'
			);
    }
?>

<br />
<h2> Mostrando <?php if(is_numeric($_GET['qtd'])) echo 'as primeiras '.$qtd; else echo $_GET['qtd'].' as';?> denuncias 
<?php if($_GET['stat']==0)echo 'por tratar'; else echo 'j&agrave; tratadas';?></h2>
<br />

<table border="1" class="grid">
<tr>
<?php foreach($headings as $heading)echo "<th>$heading</th>"; ?>      
</tr>
<?php foreach($rows as $row)
       {    echo "<tr>";
            foreach($row as $field)
            {
                echo "<td>$field</td>";
            }
            echo "</tr>";
       }
?>
</table>
<?php
?>
