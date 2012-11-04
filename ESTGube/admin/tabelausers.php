<?php
session_start();
include ('sessionctrl.php');

$reportlist = new reportlist();
$reportlist->setDblink($dblink);

$listauids = new userHandler();
$listauids->setDblink($dblink);

if($_GET['qtd']== 'todos')
	$qtd=$listauids->getusercount();
else
	if(empty($_GET['qtd'])|| !is_numeric($_GET['qtd']))
		$qtd=10;
	else
		$qtd=$_GET['qtd'];
	
$user = new User();
$user->setDblink($dblink);

$rows = array();
$headings = array('Nome','Login','Data de registo','Nivel de utilizador','Videos','Comentarios','Denuncias','estado');
?>
<br/>
<div>Ordenar por: | 
<a href="index2.php?loc=2&stat=nome&qtd=<?php echo $_GET['qtd']; ?>">nome</a> |
<a href="index2.php?loc=2&stat=data&qtd=<?php echo $_GET['qtd']; ?>"> mais recente</a> |
<a href="index2.php?loc=2&stat=videos&qtd=<?php echo $_GET['qtd']; ?>"> mais videos </a>| 
<a href="index2.php?loc=2&stat=comentarios&qtd=<?php echo $_GET['qtd']; ?>">mais comentarios</a> |
</div>
<br/>
<div> 
Mostrar os 
<a href="index2.php?loc=2&stat=<?php echo $_GET['stat']; ?>&qtd=10">10</a>
<a href="index2.php?loc=2&stat=<?php echo $_GET['stat']; ?>&qtd=20">20</a>
<a href="index2.php?loc=2&stat=<?php echo $_GET['stat']; ?>&qtd=30">30</a> primeiros utilizadores 
| <a href="index2.php?loc=2&stat=<?php echo $_GET['stat']; ?>&qtd=todos">Mostrar todos os utilizadores</a> 
</div>

<div id="search">


</div>
<?php

$op=$_GET['stat'];
switch($op)
{
case 'nome':                // ############################## MAIS COMENTADOS
{
    $uids = $listauids->getbyname(0,$qtd);
        break;
}
case 'data':     // ############################## MAIS VISTOS
{
    $uids = $listauids->getnewest(0,$qtd);
        break;
}

    case 'videos':   // ############################## MAIS RECENTES
    {
        $uids = $listauids->getbyvideos(0,$qtd);
        break;
    }
    
    case 'comentarios': // ############################## MELHOR AVALIADOS
    {
        $uids = $listauids->getbycoms(0,$qtd);
        break;
    }
    
    default:			// ############################## POR DEFEITO
    {
    $uids = $listauids->getbyname(0,$qtd);
        break;
    

	}
}
foreach($uids as $uid)
    {    
        $user->fetchUserData($uid);
            $rows[] = array($user->getNome(),
            $user->getLogin(),$user->getDatacriado(),$user->getUsrlvl(),$user->countVideos(),$user->getcommentcount(),
            $user->getreportcount($uid),
			$user->getStatus(),
			'<a href="index2.php?loc=7&uid='.$uid.'" >Gerir</a>'
			);
    }
?>

<br />
<H2> Mostrando <?php if(is_numeric($_GET['qtd'])) echo 'os primeiros '.$qtd; else echo $_GET['qtd'].' os';?> utilizadores ordenados por <?php echo $_GET['stat']; ?> </H2>
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
