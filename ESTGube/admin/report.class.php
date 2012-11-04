<?php

class report
{
	private $vid;
	private $uid;
	private $rid;
	private $report;
	private $datarep;
	private $tratado;
	private $dblink;
	
	function __contruct()
	{
		
	}
	
	function getVid() { return $this->vid; }
	function setVid($vid) { $this->vid = $vid; }
	function getUid() { return $this->uid; }
	function setUid($uid) { $this->uid = $uid; }
	function getRid() { return $this->rid; }
	function setRid($rid) { $this->rid = $rid; }
	function getReport() { return $this->report; }
	function setReport($report) { $this->report = $report; }
	function getDatarep() { return $this->datarep; }
	function setDatarep($datarep) { $this->datarep = $datarep; }
	function getTratado() { return $this->tratado; }
	function setTratado($tratado) { $this->tratado = $tratado; }
	function getDblink() { return $this->dblink; }
	function setDblink($dblink) { $this->dblink = $dblink; }

	function fetch($rid)
	{
			$stmt = $this->dblink->prepare("SELECT * FROM reports WHERE RID=?");
	    	$stmt->bind_param('d', $rid);
            $stmt->execute();
            $stmt->bind_result($this->vid,$this->uid,$this->rid,$this->report,$this->datarep,$this->tratado);
            $stmt->fetch();
            $stmt->close();
            
	}
	
	function insert()
	{
		    $stmt = $this->dblink->prepare("INSERT INTO reports (VID,UID,REPORT)VALUES (?,?,?)");
	    	$stmt->bind_param('dds', $this->vid, $this->uid, $this->report);
            $stmt->execute();
            $stmt->close();
	}
	
	function tratar()
	{	
		$st = 1;
		$stmt = $this->dblink->prepare("UPDATE reports SET tratado=? WHERE rid=?");
		$stmt->bind_param('dd',$st,$this->rid);
		$stmt->execute();
		$stmt->close();
	}
	function fetchuser()
	{
		$stmt = $this->dblink->prepare("SELECT login FROM users WHERE uid=?");
	    	$stmt->bind_param('d', $this->uid);
            $stmt->execute();
            $stmt->bind_result($nome);
            $stmt->fetch();
            $stmt->close();
            return $nome;
	}
	function fetchtitulo()
	{
			$stmt = $this->dblink->prepare("SELECT titulo FROM videos WHERE vid=?");
	    	$stmt->bind_param('d', $this->vid);
            $stmt->execute();
            $stmt->bind_result($titulo);
            $stmt->fetch();
            $stmt->close();
            return $titulo;
	}
}
?>