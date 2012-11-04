<?php
class User {
	private $uid;
	private $nome;
	private $datanasc;
	private $genero;
	private $email;
	private $usrlvl;
	private $login;
	private $pass;
	private $datacriado;
	private $status;
	private $dblink;
	private $lista;
	private $videocount;
	
	function __construct()
	{
		$lista = array();
	}

	function insertData($nome, $datanasc, $genero, $email, $login, $pass)
	{	    
	       $this->nome = $nome;
	       $this->datanasc = $datanasc;
	       $this->genero = $genero;
	       $this->email = $email;
	       //$this->usrlvl = $usrlvl;
	       $this->login = $login;
	       $this->pass = $pass;
	       //$this->status = $status;
	}

	function getUid() { return $this->uid; }
	function setUid($uid) { $this->uid = $uid; }
	function getNome() { return $this->nome; }
	function setNome($nome) { $this->nome = $nome; }
	function getDatanasc() { return $this->datanasc; }
	function setDatanasc($datanasc) { $this->datanasc = $datanasc; }
	function getGenero() { return $this->genero; }
	function setGenero($genero) { $this->genero = $genero; }
	function getEmail() { return $this->email; }
	function setEmail($email) { $this->email = $email; }
	function getUsrlvl() { return $this->usrlvl; }
	function setUsrlvl($usrlvl) { $this->usrlvl = $usrlvl; }
	function getLogin() { return $this->login; }
	function setLogin($login) { $this->login = $login; }
	function getPass() { return $this->pass; }
	function setPass($pass) { $this->pass = $pass; }
	function getDatacriado() { return $this->datacriado; }
	function setDatacriado($datacriado) { $this->datacriado = $datacriado; }
	function getStatus() { return $this->status; }
	function setStatus($status) { $this->status = $status; }
        function setDblink($dblink) { $this->dblink = $dblink; }
	function getDblink() { return $this->dblink;}
        function getVideoCount(){return $this->videocount;}
	
	
	function fetchUserData($uid)
	{
            $stmt = $this->dblink->prepare("SELECT * FROM users WHERE UID=?");
	    $stmt->bind_param('d', $uid);
            $stmt->execute();
	    $stmt->bind_result($this->uid, $this->nome, $this->datanasc, $this->genero, $this->email, $this->usrlvl, $this->login, $this->pass, $this->datacriado, $this->status);
	    $stmt->fetch();
	    $stmt->close();
	    $this->countVideos();
	}

	
	function countVideos()
	{
		$stmt = $this->dblink->prepare("SELECT COUNT(*) FROM videos WHERE UID=?");
		$stmt->bind_param('d', $this->uid);
		$stmt->execute();
		$stmt->bind_result($numvid);
		$stmt->fetch();
		$stmt->close();
		$this->videocount = $numvid;
		return $numvid;
		
		
	}
	
	function getUserVideos($inicio,$qtd)
	{
		$this->lista = array();
		 $stmt = $this->dblink->prepare("SELECT vid FROM videos WHERE uid=? LIMIT ?,?");
		$stmt->bind_param('ddd',$this->uid, $inicio, $qtd);
		$stmt->execute();
		$stmt->bind_result($vid);
		while($stmt->fetch())
			$this->lista[] = $vid;
            
            
            $stmt->close();
            return $this->lista;
	}
	
        function getAll()
        {
                $userdat = array('uid'=>$this->uid, 'nome'=>$this->nome, 'datanasc'=>$this->datanasc, 'genero'=>$this->genero, 'email'=>$this->email, 'usrlvl'=>$this->usrlvl, 'login'=>$this->login, 'pass'=>$this->pass, 'datacriado'=>$this->datacriado, 'status'=>$this->status);
                return $userdat;
        }
		
	
	function updateUser()
        {
            $stmt = $this->dblink->prepare("UPDATE users SET NOME=?, DATANASC=?, GENERO=?, EMAIL=?, USRLVL=?, PASS=?, STATUS=? WHERE UID=?;");
	    $stmt->bind_param('ssssssdd', $this->nome, $this->datanasc, $this->genero, $this->email,$this->usrlvl, $this->pass, $this->status, $this->uid);
            $stmt->execute();
            $stmt->close();  
        }
    function getcommentcount()
    {
    	$stmt = $this->dblink->prepare("SELECT count(cid) FROM comentarios WHERE uid = ?");
    	$stmt->bind_param('d',$this->uid);
    	$stmt->execute();
    	$stmt->bind_result($ccount);
    	$stmt->fetch();
    	$stmt->close(); 
    	return $ccount;
    }
	function getreportcount()
    {
    	$stmt = $this->dblink->prepare("SELECT count(rid) FROM reports WHERE uid = ?");
    	$stmt->bind_param('d',$this->uid);
    	$stmt->execute();
    	$stmt->bind_result($rcount);
    	$stmt->fetch();
    	$stmt->close(); 
    	return $rcount;
    }
    function getusercoms($inicio,$qtd)
    {
    	$this->lista = array();
    	$stmt = $this->dblink->prepare("SELECT cid FROM comentarios WHERE uid=? LIMIT ?,?");
		$stmt->bind_param('ddd',$this->uid, $inicio, $qtd);
		$stmt->execute();
		$stmt->bind_result($cid);
		while($stmt->fetch())
			$this->lista[] = $cid;
            $stmt->close();
            return $this->lista;
    }
    function disable()
    {
    	$st = 0;
    	$stmt = $this->dblink->prepare("UPDATE users SET status=? WHERE uid=?");
		$stmt->bind_param('dd',$st,$this->uid);
		$stmt->execute();
		$stmt->close();
    }
     function enable()
    {	
    	$st = 1;
    	$stmt = $this->dblink->prepare("UPDATE users SET status=? WHERE uid=?");
		$stmt->bind_param('dd',$st,$this->uid);
		$stmt->execute();
		$stmt->close();
    }
    function makesuper()
    {
    	$st = 'S';
    	$stmt = $this->dblink->prepare("UPDATE users SET usrlvl=? WHERE uid=?");
		$stmt->bind_param('sd',$st,$this->uid);
		$stmt->execute();
		$stmt->close();
    }
	function makenormal()
    {
    	$st = 'N';
    	$stmt = $this->dblink->prepare("UPDATE users SET usrlvl=? WHERE uid=?");
		$stmt->bind_param('sd',$st,$this->uid);
		$stmt->execute();
		$stmt->close();
    }
}
?>