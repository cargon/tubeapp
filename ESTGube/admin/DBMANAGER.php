<?php

class DBManager{
	private $dblink;
	
	public function DBManager(){
	}
	
	public function open_dblink(){
		$this->dblink = new mysqli('localhost', 'root', '', 'estgube');
		/* check connection */ 
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			//exit();
		} 
	}
	
	public function close_dblink(){
		/* fechar ligação */
		$this->dblink->close(); 
	}
	
	public function get_dblink(){
		return $this->dblink;
	}

	public function set_dblink($dblink){
		$this->dblink = $dblink;
	}
}
?>
