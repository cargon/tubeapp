<?php
session_start();


$listavids = new VideoList();
$listavids->setDblink($dblink);
$listavids->setUid($_SESSION['uid']);
$video = new Video();
$video->setDblink($dblink);



$rows = array();
$headings = array('Imagem','Titulo','Data de Inser&ccedil;&atilde;o','Visto','Rating','Comentarios');


    $vids = $listavids->showfavorites($_SESSION['uid']);
    foreach($vids as $vid)
    {    
        $video->fetchVideoData($vid);
            $rows[] = array('<a href="index.php?loc=4&vid='.$vid.'" > <img src="videos/'.$video->getFilename().'.jpg" alt="thumb" width="70" height="50" /> </a>'
			
			
			
			
			
			,
            $video->getTitulo(),$video->getDatains(),$video->getVezes(),$video->getRating(),$video->getCommentCount(),
			'<a href="remfavorito.php?vid='.$vid.'" onclick="return confirm(\'Quer mesmo remover este video dos seus favoritos?\');" >Apagar</a> |
			 
			 <a href="index.php?loc=4&vid='.$vid.'" >Visualizar</a>'
			);
    }
    echo '<h2> Videos mais vistos</h2>';




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
