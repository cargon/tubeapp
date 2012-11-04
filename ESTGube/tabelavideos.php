<?php
session_start();


$listavids = new VideoList();
$listavids->setDblink($dblink);
$listavids->setUid($_SESSION['uid']);
$video = new Video();
$video->setDblink($dblink);

$user = new User();
$user->setDblink($dblink);
$user->fetchUserData($_SESSION['uid']);

$rows = array();
$headings = array('Imagem','Titulo','Data de Inser&ccedil;&atilde;o','Visto','Rating','Comentarios');
?>

<div>Ordenar por: | <a href="index.php?loc=6&stat=com">mais comentados</a> |<a href="index.php?loc=6&stat=views"> mais vistos</a> |<a href="index.php?loc=6&stat=rated"> melhor avaliados </a>| <a href="index.php?loc=6&stat=recent">mais recentes</a> |</div>

<?php

$op=$_GET['stat'];
switch($op)
{
case 'com':                // ############################## MAIS COMENTADOS
{
    $vids = $listavids->getMaisComentados(0,$user->getVideoCount());
    foreach($vids as $vid)
    {    
        $video->fetchVideoData($vid[0]);
        if($video->getUid() == $_SESSION['uid'])
            $rows[] = array("<img src=\"videos/".$video->getFilename().".jpg\" alt=\"thumb\" width=\"70\" height=\"50\" />",
            $video->getTitulo(),$video->getDatains(),$video->getVezes(),$video->getRating(),$vid[1],
			'<a href="apagarvideo.php?vid='.$vid.'" onclick="return confirm(\'Quer mesmo apagar este video?\');" >Apagar</a> |
			 <a href="index.php?loc=7&vid='.$vid.'" >Editar</a> |
			 <a href="index.php?loc=8&vid='.$vid.'" >Visualizar</a>'
			);
    }
    echo '<h2> Videos mais Comentados</h2>';
    break;
}
case 'views':     // ############################## MAIS VISTOS
{
    $vids = $listavids->getMaisVistos(0,$user->getVideoCount());
    foreach($vids as $vid)
    {    
        $video->fetchVideoData($vid);
        if($video->getUid() == $_SESSION['uid'])
            $rows[] = array("<img src=\"videos/".$video->getFilename().".jpg\" alt=\"thumb\" width=\"70\" height=\"50\" />",
            $video->getTitulo(),$video->getDatains(),$video->getVezes(),$video->getRating(),$video->getCommentCount(),
			'<a href="apagarvideo.php?vid='.$vid.'" onclick="return confirm(\'Quer mesmo apagar este video?\');" >Apagar</a> |
			 <a href="index.php?loc=7&vid='.$vid.'" >Editar</a> |
			 <a href="index.php?loc=8&vid='.$vid.'" >Visualizar</a>'
			);
    }
    echo '<h2> Videos mais vistos</h2>';
    break;
}

    case 'recent':   // ############################## MAIS RECENTES
    {
        $vids = $listavids->getMaisRecentes(0,$user->getVideoCount());
        foreach($vids as $vid)
         {    
            $video->fetchVideoData($vid);
            if($video->getUid() == $_SESSION['uid'])
                $rows[] = array("<img src=\"videos/".$video->getFilename().".jpg\" alt=\"thumb\" width=\"70\" height=\"50\" />",
                        $video->getTitulo(),$video->getDatains(),$video->getVezes(),$video->getRating(),$video->getCommentCount(),
			'<a href="apagarvideo.php?vid='.$vid.'" onclick="return confirm(\'Quer mesmo apagar este video?\');" >Apagar</a> |
			 <a href="index.php?loc=7&vid='.$vid.'" >Editar</a> |
			 <a href="index.php?loc=8&vid='.$vid.'" >Visualizar</a>'
			);
        }
        echo '<h2> Videos mais recentes</h2>';
        break;
    }
    
    case 'rated': // ############################## MELHOR AVALIADOS
    {
        $vids = $listavids->getMostRated(0,$user->getVideoCount());
    foreach($vids as $vid)
    {    
        $video->fetchVideoData($vid);
        if($video->getUid() == $_SESSION['uid'])
            $rows[] = array("<img src=\"videos/".$video->getFilename().".jpg\" alt=\"thumb\" width=\"70\" height=\"50\" />",
            $video->getTitulo(),$video->getDatains(),$video->getVezes(),$video->getRating(),$video->getCommentCount(),
			'<a href="apagarvideo.php?vid='.$vid.'" onclick="return confirm(\'Quer mesmo apagar este video?\');" >Apagar</a> |
			 <a href="index.php?loc=7&vid='.$vid.'" >Editar</a> |
			 <a href="index.php?loc=8&vid='.$vid.'" >Visualizar</a>'
			);
    }
        echo '<h2> Videos melhor avaliados</h2>';
        break;
    }
    
    default:			// ############################## POR DEFEITO
    {
    $vids = $listavids->getMaisVistos(0,$user->getVideoCount());
    foreach($vids as $vid)
    {    
        $video->fetchVideoData($vid);
        if($video->getUid() == $_SESSION['uid'])
            $rows[] = array("<img src=\"videos/".$video->getFilename().".jpg\" alt=\"thumb\" width=\"70\" height=\"50\" />",
            $video->getTitulo(),$video->getDatains(),$video->getVezes(),$video->getRating(),$video->getCommentCount(),
			'<a href="apagarvideo.php?vid='.$vid.'" onclick="return confirm(\'Quer mesmo apagar este video?\');" >Apagar</a> |
			 <a href="index.php?loc=7&vid='.$vid.'" >Editar</a> |
			 <a href="index.php?loc=8&vid='.$vid.'" >Visualizar</a>'
			);
    }
    echo '<h2> Videos mais vistos</h2>';
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
