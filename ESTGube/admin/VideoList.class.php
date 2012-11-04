<?php


class VideoList
{
    
    private $dblink;
    private $vidlist;
    private $uid;
    
    
    function getDblink() { return $this->dblink; }
    function setDblink($dblink){ $this->dblink = $dblink; }
    function getUid() { return $this->uid; }
    function setUid($uid){ $this->uid = $uid; }
/////////////////////////////////////////////////////////////////////////////////

    function __construct()
    {
       $this->vidlist = array();
    }
    
//______________________________________________________________________________________________    
    function insertVideo($uid, $titulo, $descricao, $filename)
    {
        
        
        $stmt = $this->dblink->prepare("INSERT INTO videos (UID, TITULO, DESCRICAO, FILENAME) VALUES (?, ?, ?, ?)");
	$stmt->bind_param('dsss', $uid, $titulo, $descricao, $filename);
        if($stmt->execute())
        {
            $vid = $stmt->insert_id;
            $stmt = $this->dblink->prepare("INSERT INTO ratings (vid) VALUES (?)");
            $stmt->bind_param('d',$vid);
            $stmt->execute();
            $stmt->close();
            
            return $vid;
        }
        else
        {
            $stmt->close();
            return FALSE;
        }
        
    }
//_____________________________________________________________________________________________
    function getVideos($field,$order,$inicio,$num)
    {
            $stmt = $this->dblink->prepare("SELECT * FROM videos ORDER BY ? ? LIMIT ?,?");
            $stmt->bind_params('ssdd',$field,$order,$inicio,$num);
            $stmt->execute();
            $stmt->bind_result($vid);
            while($stmt->fetch());
                $vidlist[] = $vid;
            $stmt->close();
	    return $vidlist;
    }
//______________________________________________________________________________________________
        function getVideoByID($vid)
        {
            $video = new Video();
            $video->fetchVideoData($vid,$this->dblink);
            return $video;
        }
        
//_____________________________________________________________________________________________        
         function addRating($newrating)
        {
            $stmt = $this->dblink->prepare("UPDATE ratings SET RATING=?, VOTOS=?, WHERE (VID=? AND UID=?);");
	    $this->rating += $newrating;
	    $this->votos++;
	    $stmt->bind_param('dddd', $this->rating, $this->votos, $this->vid, $this->uid);
            $stmt->execute();
            $stmt->close();
        }
        
        
//______________________________________________________________________________________________
        function deleteVideo($video)
        {           
            $vid = $video->getVid();
            $stmt = $this->dblink->prepare("DELETE FROM comentarios WHERE vid=?");
	    $stmt->bind_param('d', $vid);
           $filename = $video->getFilename();
            
            if($stmt->execute())
            {
                $stmt = $this->dblink->prepare("DELETE FROM ratings WHERE vid=?");
                $stmt->bind_param('d', $vid);
                if($stmt->execute())
                {
                	$stmt = $this->dblink->prepare("DELETE FROM reports WHERE vid=?");
                	$stmt->bind_param('d', $vid);
                	if($stmt->execute())
                	{
                     $stmt = $this->dblink->prepare("DELETE FROM videos WHERE vid=?");
                     $stmt->bind_param('d', $vid);
                     if($stmt->execute())
                        {
                            unlink("../videos/".$filename.".flv");
                            unlink("../videos/".$filename.".jpg");
                        }
                	}
                }
            }
            $stmt->close(); 
        }
        
//______________________________________________________________________________________________       
        function getMaisComentados($inicio,$qtd)
        {
            if(empty($this->uid))
            {
                $stmt=$this->dblink->prepare("SELECT videos.vid, Count(comentarios.VID )
                                            FROM videos
                                            LEFT JOIN comentarios ON comentarios.VID = videos.VID
                                            GROUP BY videos.vid
                                            ORDER by COUNT(comentarios.VID) DESC LIMIT ?,?");
                                            $stmt->bind_param('dd',$inicio,$qtd);
            }
			else
            {
                $stmt=$this->dblink->prepare("SELECT videos.vid, Count(comentarios.VID )
                                            FROM videos
                                            LEFT JOIN comentarios ON comentarios.VID = videos.VID
                                            WHERE videos.uid = ?
                                            GROUP BY videos.vid
                                            ORDER by COUNT(comentarios.VID) DESC LIMIT ?,?");
                $stmt->bind_param('ddd',$this->uid,$inicio,$qtd);
            }
           $stmt->execute();
           $stmt->bind_result($vid,$ccount);
            while($stmt->fetch())
            {
                $this->vidlist[] = array($vid,$ccount);
            }
            return $this->vidlist;
        }
//______________________________________________________________________________________________        
        function getMaisRecentes($inicio, $qtd)
        {
            if(empty($this->uid))
            {
                $stmt = $this->dblink->prepare("SELECT vid FROM videos ORDER BY datains DESC LIMIT ?,?" );
                $stmt->bind_param('dd',$inicio,$qtd);
            }
            else
            {
                $stmt = $this->dblink->prepare("SELECT vid FROM videos WHERE uid=? ORDER BY datains DESC LIMIT ?,?" );
                $stmt->bind_param('ddd',$this->uid,$inicio,$qtd);
            }
            
            $stmt->execute();
            $stmt->bind_result($vid);
            while($stmt->fetch())
                $this->vidlist[] = $vid;
            return $this->vidlist;
        }
//______________________________________________________________________________________________        
        function getMaisVistos($inicio,$qtd)
        {
            
             if(empty($this->uid))
             {
                $stmt = $this->dblink->prepare("SELECT vid FROM videos ORDER BY vezes DESC LIMIT ?,?");
                $stmt->bind_param('dd',$inicio,$qtd);
             }
             else
             {
                $stmt = $this->dblink->prepare("SELECT vid FROM videos WHERE uid=? ORDER BY vezes DESC LIMIT ?,?");
                $stmt->bind_param('ddd',$this->uid,$inicio,$qtd);
             }
            $stmt->execute();
            $stmt->bind_result($vid);
            while($stmt->fetch())
                $this->vidlist[] = $vid;
            
            
            $stmt->close();
            
            return $this->vidlist;
        }
//______________________________________________________________________________________________        
        function getMostRated($inicio,$qtd)
        {
        	if(empty($this->uid))
        	{
            	$stmt=$this->dblink->prepare("SELECT vid FROM ratings ORDER BY IF(votos=0,0,rating/votos) DESC LIMIT ?,?");
            	$stmt->bind_param('dd',$inicio,$qtd);
            $stmt->execute();
            }
			else
            {
            	$stmt=$this->dblink->prepare("SELECT r.vid FROM ratings r, videos v WHERE v.uid=? AND v.vid = r.vid ORDER BY IF(votos=0,0,rating/votos) DESC LIMIT ?,?");
            	$stmt->bind_param('ddd', $this->uid, $inicio, $qtd);
            	$stmt->execute();
            }
            $stmt->bind_result($vid);
            while($stmt->fetch())
            {
            	$this->vidlist[] = $vid;
            }
            return $this->vidlist;        
        }
//______________________________________________________________________________________________        
        function search($searchstring)
        {   $str = "%".$searchstring."%";
            $stmt = $this->dblink->prepare("SELECT VID FROM videos WHERE titulo LIKE ? OR descricao LIKE ?;");
            $stmt->bind_param('ss', $str,$str);
            $stmt->execute();
            $stmt->bind_result($vid);
            while($stmt->fetch())
            {
                $this->vidlist[] = $vid;
            }
    
            $stmt->close();
            return $this->vidlist;
        }
//______________________________________________________________________________________________
		function showfavorites($uid)
		{
			$stmt = $this->dblink->prepare("SELECT vid FROM favoritos WHERE uid=?");
			$stmt->bind_param('d',$uid);
			$stmt->execute();
			$stmt->bind_result($vid);
			while($stmt->fetch())
			{
				$this->vidlist[]=$vid;
			}
			$stmt->close();
			return $this->vidlist;
		}
		function getVideoCount()
		{
			$stmt = $this->dblink->prepare("SELECT count(vid) FROM videos");
			$stmt->execute();
			$stmt->bind_result($count);
			$stmt->fetch();
			$stmt->close();
			return $count;
		}
}
?>