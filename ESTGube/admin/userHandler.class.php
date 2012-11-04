<?php


class userHandler
{
private $dblink;
private $lista;



function __construct()
{
    $this->lista = array();
}


function setDblink($dblink)
{
    $this->dblink = $dblink;
}


function insertUser($user)
{
    $stmt = $this->dblink->prepare("INSERT INTO users (NOME, DATANASC, GENERO, EMAIL, LOGIN, PASS) VALUES (?, ?, ?, ?, ?,?)");
                        $stmt->bind_param('ssssss', $nome, $datanasc, $genero, $email, $login, $pass); 
			$nome = $user->getNome(); 
			$datanasc = $user->getDatanasc(); 
			$genero = $user->getGenero(); 
			$email = $user->getEmail(); 
			$login = $user->getLogin();
                        $pass = $user->getPass();
			if($stmt->execute())
                        {
                            
                            $stmt->close();
                            return true;
                        }
                        else
                        {
                            $stmt->close();
                            return false;
                        }
    
}

//----------------------------------------------------------------------------------
    function getUserVideos()
        {
            $stmt = $this->dblink->prepare("SELECT FROM videos WHERE UID=?;");
	    $stmt->bind_param('s', $this->uid);
            $stmt->execute();
            $stmt->bind_result($vid,$uid,$titulo,$descricao,$filename,$vezes,$datains);
            while($stmt->fetch());
                $videos[] = array('vid'=>$vid,'uid'=>$uid,'titulo'=>$titulo,'descricao'=>$descricao,'filename'=>$filename,'vezes'=>$vezes,'datains'=>$datains);
            $stmt->close();    
            return $videos;
        }
//----------------------------------------------------------------------------------
    	function getbyname($inicio,$qtd)
    	{
    		$stmt = $this->dblink->prepare("SELECT uid from users ORDER BY nome ASC LIMIT ?,?");
    		$stmt->bind_param('dd',$inicio,$qtd);
    		$stmt->execute();
    		$stmt->bind_result($uid);
    		while($stmt->fetch())
    		{
    			$this->lista[]=$uid;
    		}
    		$stmt->close();
    		return $this->lista;
    	}
    	function getnewest($inicio,$qtd)
    	{
    		$stmt = $this->dblink->prepare("SELECT uid from users ORDER BY datacriado DESC LIMIT ?,?");
    		$stmt->bind_param('dd',$inicio,$qtd);
    		$stmt->execute();
    		$stmt->bind_result($uid);
    		while($stmt->fetch())
    		{
    			$this->lista[]=$uid;
    		}
    		$stmt->close();
    		return $this->lista;
    	}
    	function getbycoms($inicio,$qtd)
    	{
    		$stmt = $this->dblink->prepare("SELECT u.uid
											FROM comentarios c
											RIGHT JOIN users u  on c.uid = u.uid
											GROUP BY (u.uid)
											ORDER BY count(c.vid) DESC LIMIT ?,?");
											
			$stmt->bind_param('dd',$inicio,$qtd);
    		$stmt->execute();
    		$stmt->bind_result($uid);
    		while($stmt->fetch())
    		{
    			$this->lista[]=$uid;
    		}
    		$stmt->close();
    		return $this->lista;
    	}
    	function getbyvideos($inicio,$qtd)
    	{
    		$stmt = $this->dblink->prepare("SELECT u.uid
											FROM videos v
											RIGHT JOIN users u  on v.uid = u.uid
											GROUP BY (u.uid)
											ORDER BY count(v.vid) DESC LIMIT ?,?");
			$stmt->bind_param('dd',$inicio,$qtd);
    		$stmt->execute();
    		$stmt->bind_result($uid);
    		while($stmt->fetch())
    		{
    			$this->lista[]=$uid;
    		}
    		$stmt->close();
    		return $this->lista;
    	}
    function getusercount()
    {
    	$stmt = $this->dblink->prepare("SELECT count(uid) FROM users");
    	$stmt->execute();
    	$stmt->bind_result($ucount);
    	$stmt->fetch();
    	$stmt->close(); 
    	return $ucount;
    }
    	

}
?>