<?php
class Comment {
	private $vid;
	private $uid;
	private $cid;
	private $comentario;
	private $datacom;
        private $dblink;
        public $user;
        
        function __construct()
        {
            
        }
        
	function inserirValores($vid, $uid, $comentario)
        {
		$this->vid = $vid;
		$this->uid = $uid;
		$this->comentario = $comentario;
	}
        
        function fetchNome($uid)
        {
            $stmt = $this->dblink->prepare("SELECT login FROM users WHERE UID=?");
            $stmt->bind_param('d',$uid);
            $stmt->execute();
            $stmt->bind_result($user);
            $stmt->fetch();
            $stmt->close();
            return $user;
        }
        
        function fetchComData($cid)
        {
            $stmt = $this->dblink->prepare("SELECT * FROM comentarios WHERE CID=?");
	    	$stmt->bind_param('d', $cid);
            $stmt->execute();
            $stmt->bind_result($this->vid,$this->uid,$this->cid,$this->comentario,$this->datacom);
            $stmt->fetch();
            $stmt->close();
            $this->user = $this->fetchNome($this->uid);
	    
        }
        
        function inserirComentario()
        {
            $stmt = $this->dblink->prepare("INSERT INTO comentarios (VID,UID,COMENTARIO)VALUES (?,?,?)");
	    $stmt->bind_param('dds', $this->vid, $this->uid, $this->comentario);
            $stmt->execute();
            $stmt->close();
        }
        function apagarComentario()
        {
             $stmt = $this->dblink->prepare("DELETE FROM comentarios WHERE cid=?");
             $stmt->bind_param('d', $this->cid);
             $stmt->execute();
             $stmt->close();
        }
        
        
        
        
	function getVid() { return $this->vid; }
	function setVid($vid) { $this->vid = $vid; }
	function getUid() { return $this->uid; }
	function setUid($uid) { $this->uid = $uid; }
	function getCid() { return $this->cid; }
	function setCid($cid) { $this->cid = $cid; }
	function getComentario() { return $this->comentario; }
	function setComentario($comentario) { $this->comentario = $comentario; }
	function getDatacom() { return $this->datacom; }
	function setDatacom($datacom) { $this->datacom = $datacom; }
        function getDblink(){ return $this->dblink; }
        function setDblink($dblink) { $this->dblink = $dblink;}
        function getUser(){ return $this->user;}
        function setUser($user){ $this->user = $user; }
}
?>