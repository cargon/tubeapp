<?php
session_start();
include ('sessionctrl.php');

$reportlist = new reportlist();
$reportlist->setDblink($dblink);

$listavids = new VideoList();
$listavids->setDblink($dblink);
if($_GET['qtd']== 'todos')
	$qtd=$listavids->getVideoCount();
else
	if(empty($_GET['qtd'])|| !is_numeric($_GET['qtd']))
		$qtd=10;
	else
		$qtd=$_GET['qtd'];
	
$video = new Video();
$video->setDblink($dblink);

$user = new User();
$user->setDblink($dblink);
$user->fetchUserData($_SESSION['uid']);

$rows = array();
$headings = array('Imagem','Titulo','Data de Inser&ccedil;&atilde;o','Visto','Rating','Comentarios','denuncias','Estado');
?>
<br/>
<div>Ordenar por: | 
<a href="index2.php?loc=5&stat=com&qtd=<?php echo $_GET['qtd']; ?>">mais comentados</a> |
<a href="index2.php?loc=5&stat=views&qtd=<?php echo $_GET['qtd']; ?>"> mais vistos</a> |
<a href="index2.php?loc=5&stat=rated&qtd=<?php echo $_GET['qtd']; ?>"> melhor avaliados </a>| 
<a href="index2.php?loc=5&stat=recent&qtd=<?php echo $_GET['qtd']; ?>">mais recentes</a> |
</div>
<br/>
<div> 
Mostrar os 
<a href="index2.php?loc=5&stat=<?php echo $_GET['stat']; ?>&qtd=10">10</a>
<a href="index2.php?loc=5&stat=<?php echo $_GET['stat']; ?>&qtd=20">20</a>
<a href="index2.php?loc=5&stat=<?php echo $_GET['stat']; ?>&qtd=30">30</a> primeiros videos 
| <a href="index2.php?loc=5&stat=<?php echo $_GET['stat']; ?>&qtd=todos">Mostrar todos os videos</a> 
</div>

<div id="search">


</div>
<?php

$op=$_GET['stat'];
switch($op)
{
case 'com':                // ############################## MAIS COMENTADOS
{
    $vids = $listavids->getMaisComentados(0,$qtd);
    foreach($vids as $vid)
    {    
        $video->fetchVideoData($vid[0]);
            $rows[] = array("<img src=\"../videos/".$video->getFilename().".jpg\" alt=\"thumb\" width=\"70\" height=\"50\" />",
            $video->getTitulo(),$video->getDatains(),$video->getVezes(),$video->getRating(),$vid[1],$reportlist->countvideoreports($vid[0]),
            $video->getStatus(),
			 '<a href="index2.php?loc=4&vid='.$vid[0].'" >Gerir</a>'
			);
    }
	echo '<br/> Mostrando '.$_GET['qtd'];
    echo '<h2> Videos mais Comentados</h2>';
    break;
}
case 'views':     // ############################## MAIS VISTOS
{
    $vids = $listavids->getMaisVistos(0,$qtd);
    foreach($vids as $vid)
    {    
        $video->fetchVideoData($vid);
        
            $rows[] = array("<img src=\"../videos/".$video->getFilename().".jpg\" alt=\"thumb\" width=\"70\" height=\"50\" />",
            $video->getTitulo(),$video->getDatains(),$video->getVezes(),$video->getRating(),$video->getCommentCount(),
            $reportlist->countvideoreports($vid),
            $video->getStatus(),
			'<a href="index2.php?loc=4&vid='.$vid.'" >Gerir</a>'
			);
    }
	echo '<br/> Mostrando '.$_GET['qtd'];
    echo '<h2> Videos mais vistos </h2>';
    break;
}

    case 'recent':   // ############################## MAIS RECENTES
    {
        $vids = $listavids->getMaisRecentes(0,$qtd);
        foreach($vids as $vid)
         {    
            $video->fetchVideoData($vid);
                $rows[] = array("<img src=\"../videos/".$video->getFilename().".jpg\" alt=\"thumb\" width=\"70\" height=\"50\" />",
                        $video->getTitulo(),$video->getDatains(),$video->getVezes(),$video->getRating(),$video->getCommentCount(),
                        $reportlist->countvideoreports($vid),
                        $video->getStatus(),
				'<a href="index2.php?loc=4&vid='.$vid.'" >Gerir</a>'
			);
        }
		echo '<br/> Mostrando '.$_GET['qtd'];
        echo '<h2> Videos mais recentes </h2>';
        break;
    }
    
    case 'rated': // ############################## MELHOR AVALIADOS
    {
        $vids = $listavids->getMostRated(0,$qtd);
    foreach($vids as $vid)
    {    
        $video->fetchVideoData($vid);
            $rows[] = array("<img src=\"../videos/".$video->getFilename().".jpg\" alt=\"thumb\" width=\"70\" height=\"50\" />",
            $video->getTitulo(),$video->getDatains(),$video->getVezes(),$video->getRating(),$video->getCommentCount(),
            $reportlist->countvideoreports($vid),
            $video->getStatus(),
			'<a href="index2.php?loc=4&vid='.$vid.'" >Gerir</a>'
			);
    }
		echo '<br/> Mostrando '.$_GET['qtd'];
        echo '<h2> Videos melhor avaliados </h2>';
        break;
    }
    
    default:			// ############################## POR DEFEITO
    {
    $vids = $listavids->getMaisVistos(0,$qtd);
    foreach($vids as $vid)
    {    
        $video->fetchVideoData($vid);
            $rows[] = array("<img src=\"../videos/".$video->getFilename().".jpg\" alt=\"thumb\" width=\"70\" height=\"50\" />",
            $video->getTitulo(),$video->getDatains(),$video->getVezes(),$video->getRating(),$video->getCommentCount(),
            $reportlist->countvideoreports($vid),
            $video->getStatus(),
			'<a href="index2.php?loc=4&vid='.$vid.'" >Gerir</a>'
			);
    }
	echo '<br/> Mostrando '.$_GET['qtd'];
    echo '<h2> Videos mais vistos </h2>';
    break;
}
}

?>
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
