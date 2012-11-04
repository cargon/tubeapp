<?php
	$file=$_GET["video"];
        $image=$_GET["thumb"];
?>
<html>
	<head>
		<title>...</title>
		<script type="text/javascript" src="swfobject.js"></script>
	</head>
	<body>


		<div id="flashcontent" align="center"><p style="font-weight:bold;font-size:14pt;">Para ver este vídeo é necessário ter<br>no mínimo a versão 8 do Flash Player.</p><p><a href="http://www.adobe.com/flashplayer/">download</a>.</p></div>
		<script type="text/javascript">
			// <![CDATA[
			var so = new SWFObject("flvplayer.swf?theFile=<?php echo "$file";?>&defaultImage=<?php echo "$image";?>&theVolume=100&startPlayingOnload=no&popUpHelp=no&bufferSeconds=2&videoSmoothing=yes","flvplayer","320","255","8","#000000");
			so.addParam("movie","flvplayer.swf?theFile=<?php echo "$file";?>&defaultImage=<?php echo "$image";?>&theVolume=100&startPlayingOnload=no&popUpHelp=no&bufferSeconds=2&videoSmoothing=yes");
			so.addParam("bgcolor","#000000");
			so.write("flashcontent");
			// ]]>
		</script>
		
	
</body>
</html>