<?php
    class Video {
	private $vid;
	private $uid;
	private $titulo;
	private $descricao;
	private $filename;
	private $vezes;
	private $rating;
	private $votos;
    private $dblink;
    private $datains;
	private $lista;
	private $user;
        private $ccount;
    private $status;
	function __construct()
        {
            $this->lista = array();
        }
        
        //GETTERS and SETTERS
	function getVid() { return $this->vid; }
	function setVid($vid) { $this->vid = $vid; }
	function getUid() { return $this->uid; }
	function setUid($uid) { $this->uid = $uid; }
	function getTitulo() { return $this->titulo; }
	function setTitulo($titulo) { $this->titulo = $titulo; }
	function getDescricao() { return $this->descricao; }
	function setDescricao($descricao) { $this->descricao = $descricao; }
	function getFilename() { return $this->filename; }
	function setFilename($filename) { $this->filename = $filename; }
	function getVezes() { return $this->vezes; }
	function setVezes($vezes) { $this->vezes = $vezes; }
	function getRating() { return $this->rating; }
	function setRating($rating) { $this->rating = $rating; }
	function getVotos() { return $this->votos; }
	function setVotos($votos) { $this->votos = $votos; }
        function getDblink() { return $this->dblink; }
        function setDblink($dblink){ $this->dblink = $dblink; }
	function getDb() { return $this->db; }
	function setDb($db){ $this->db = $db; } 
        function getDatains() { return $this->datains; }
	function setDatains($datains){ $this->datains = $datains; }
        function getUSer(){ return $this->user;}
        function setUser($user){$this->user = $user;}
        function getCcount() {return $this->ccount; }
        function getStatus() {return $this->status;}
        function setStatus($status){$this->status = $status;}
        ////////////////////////////////////////////////////////////////////////////////////////////  
        //##########################################################################################
       
        function fetchVideoData($vid)
	{
	    $stmt = $this->dblink->prepare("SELECT * FROM videos WHERE VID=?");
	    $stmt->bind_param('d', $vid);
            $stmt->execute();
            $stmt->bind_result($this->vid,$this->uid,$this->titulo,$this->descricao,$this->filename,$this->vezes,$this->datains,$this->status);
            $stmt->fetch();
            $stmt->close();
	    $this->fetchRating();
            $this->fetchUser();
	}
        
        private function fetchRating()
        {
            if(strlen($this->vid > 0 && $this->uid > 0 ))
            {
            $stmt = $this->dblink->prepare("SELECT RATING, VOTOS FROM ratings WHERE VID=?");
	    $stmt->bind_param('d', $this->vid);
            $stmt->execute();
            $stmt->bind_result($rating,$this->votos);
            $stmt->fetch();
            if($this->votos == 0)
                $this->rating = 0 ;
            else
                $this->rating = $rating/$this->votos;
            $stmt->close();
            }
        }
        
        function getComments()
        {
            $stmt = $this->dblink->prepare("SELECT CID FROM comentarios WHERE VID=?");
            $stmt->bind_param('d',$this->vid);
            $stmt->execute();
            $stmt->bind_result($cid);
            while($stmt->fetch())
            {
                $this->lista[] = $cid;
            }
            $stmt->close();
            return $this->lista;
        }
        
        function getCommentCount()
        {
            $stmt = $this->dblink->prepare("SELECT COUNT(*) FROM comentarios WHERE VID=?");
            $stmt->bind_param('d',$this->vid);
            $stmt->execute();
            $stmt->bind_result($this->ccount);
            $stmt->fetch();
            return $this->ccount;
        }
        function updateVideo()
        {
            $stmt = $this->dblink->prepare("UPDATE videos SET TITULO=?, DESCRICAO=?, VEZES=? WHERE VID=?");
	    $stmt->bind_param('ssdd', $this->titulo, $this->descricao, $this->vezes, $this->vid);
            $stmt->execute();
            $stmt->close();
        }
        
        function fetchUser()
        {
            $stmt = $this->dblink->prepare("SELECT login FROM users WHERE UID=?");
            $stmt->bind_param('d',$this->uid);
            $stmt->execute();
            $stmt->bind_result($this->user);
            $stmt->fetch();
            $stmt->close();
        }
        function isfavorite($uid)
        {
        	$stmt = $this->dblink->prepare("SELECT vid FROM favoritos WHERE (uid=? AND vid=?)");
        	$stmt->bind_param('dd',$uid,$this->vid);
        	$stmt->execute();
        	$stmt->bind_result($vid);
        	if($stmt->fetch())
        		return true;
        	else
        		return false;
        }
        function isreported($uid)
        {
        	$stmt = $this->dblink->prepare("SELECT vid FROM reports WHERE (uid=? AND vid=?)");
        	$stmt->bind_param('dd',$uid,$this->vid);
        	$stmt->execute();
        	$stmt->bind_result($vid);
        	if($stmt->fetch())
        		return true;
        	else
        		return false;
        }
         function enable()
    	{	
    		$st=1;
    		$stmt = $this->dblink->prepare("UPDATE videos SET status=? WHERE vid=?");
			$stmt->bind_param('dd',$st,$this->vid);
			$stmt->execute();
			$stmt->close();
    	}
    	
         function disable()
    	{	
    		$st=0;
    		$stmt = $this->dblink->prepare("UPDATE videos SET status=? WHERE vid=?");
			$stmt->bind_param('dd',$st,$this->vid);
			$stmt->execute();
			$stmt->close();
    	}
}

?>