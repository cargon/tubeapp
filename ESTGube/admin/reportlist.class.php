<?php
class reportlist
{
	private $lista;
	private $dblink;


	function getDblink() { return $this->dblink; }
	function setDblink($dblink) { $this->dblink = $dblink; }

		function reportlist()
		{
			$lista = array();
		}
	function fetchlastreports($inicio,$qtd)
	{
		$this->lista = array();
		$stmt = $this->dblink->prepare('SELECT rid FROM reports WHERE tratado = 0 ORDER BY datarep DESC LIMIT ?,?');	
		$stmt->bind_param('dd',$inicio, $qtd);	
		$stmt->execute();
		$stmt->bind_result($rid);
		while($stmt->fetch())
			$this->lista[]=$rid;
		$stmt->close();
		return $this->lista;
		
	}
	
	function fetchtratados($inicio,$qtd)
	{
		$this->lista = array();
		$stmt = $this->dblink->prepare('SELECT rid FROM reports WHERE tratado = 1 ORDER BY datarep DESC LIMIT ?,?');	
		$stmt->bind_param('dd',$inicio, $qtd);	
		$stmt->execute();
		$stmt->bind_result($rid);
		while($stmt->fetch())
			$this->lista[]=$rid;
		$stmt->close();
		return $this->lista;
	}
	
	
	function countvideoreports($vid)
	{
		$stmt = $this->dblink->prepare('SELECT count(rid) FROM reports WHERE vid = ?');	
		$stmt->bind_param('d',$vid);	
		$stmt->execute();
		$stmt->bind_result($rcount);
		$stmt->fetch();
		$stmt->close();
		return $rcount;
	}
	function reportcount()
	{
		$stmt = $this->dblink->prepare('SELECT count(rid) FROM reports');		
		$stmt->execute();
		$stmt->bind_result($rcount);
		$stmt->fetch();
		$stmt->close();
		return $rcount;
	}
}
?>