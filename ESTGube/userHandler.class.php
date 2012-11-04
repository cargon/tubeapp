<?php


class userHandler
{
private $dblink;




function __construct()
{
    
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
    

}
?>