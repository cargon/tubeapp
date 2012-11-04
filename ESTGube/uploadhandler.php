<?php

include('sessionctrl.php');
session_start();
include "DBMANAGER.php";
include "VideoList.class.php";
$db = new DBManager();

if($_FILES['upfile']['sise'] > 15728640 ) die('o tamanho do ficheiro é demasiado grande');	



$base = time().'_'.$_SESSION["uid"];

$input = $base.'tpv';

if (move_uploaded_file($_FILES["upfile"]["tmp_name"],"./videos/".$input))
{
	
	
	//Converter o video	
	$output = $base.".flv";
	
	
	
	$convertstring = "converter\\ffmpeg.exe -i \"videos\\$input\" -acodec mp3 -ar 22050 -ab 32 -f flv -s 320x240 \"videos\\$output\"\n";
	
	$result = system($convertstring);
	 if(file_exists("videos\\".$input))
		unlink("videos\\".$input);
		
	// criar a thumbnail
	$thumbfecthstring = "converter\\ffmpeg.exe -i \"videos\\$output\" -ss 0 -t 1 -f mjpeg \"videos\\$base.jpg";
	system($thumbfecthstring);
	
	
	
	////// inserir dados na db
	if(file_exists("videos\\$output") && file_exists("videos\\$base.jpg"))
	{
		$db->open_dblink();
		$dblink = $db->get_dblink();
		
		$lista = new VideoList();
		$lista->setDblink($dblink);
		if ($vid = $lista->insertVideo($_SESSION["uid"],$_POST["titulo"],$_POST["descricao"],$base))
		{
			
			header("Location: index.php?loc=4&vid=$vid");
		}
		else
		{
			echo "nao deu";
		}
		$db->close_dblink();
		
	}
	
}
else
{
	echo 'video muito grande, ou formato nao suportado';
}

?>