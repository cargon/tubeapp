
<?php defined( 'EXECUTA' ) or die( 'Acesso Negado' );
session_start();
$user = new User();
$user->setDblink($dblink);
$user->fetchUserData($_SESSION['uid']);

$data = $user->getDatanasc();
$dataarray = explode('-',$data);
?>



<fieldset class="fscontainer"><legend class="lgcontainer">Editar Utilizador</legend>

<form action="edituser.php" method="post" name="newuser" >

	<fieldset class="fscomponent"><legend class="lgcomponent">Dados de Autenticação</legend>
        <table>
  	<tr>
          <td> <label> Nome de Utilizador: </label> </td>
    	  <td><input disabled="disabled" name="login" type="text" size="30" maxlength="20" value="<?php echo $user->getLogin(); ?>"/></td>
	</tr>
        <tr>
          <td> <label>Palavra Passe: </label> </td>
  	  <td>  <input name="pass" type="password" size="30" maxlength="20" /> </td>
        </tr>
        <tr>
          <td> <label>Confirme a Palavra-Passe: </label> </td>
  	  <td>  <input name="pass2" type="password" size="30" maxlength="20" /> </td>
        </tr>
          </table>  	
        </fieldset>
        
  	<fieldset class="fscomponent"><legend class="lgcomponent">Dados Pessoais</legend>
  	<table>
        <tr>
          <td> <label> Nome: </label> </td>
    	  <td> <input type="text" name="nome" id="nunome" size="60" value="<?php echo $user->getNome(); ?>" /> </td>
  	</tr>
        <tr>  
  	<td> <label>Data de Nascimento: </label> </td>
          <td> 
            <input name="nuano" type="text" size="3" maxlength="4" value="<?php echo $dataarray[0]; ?>"/>
              - 
            <input name="numes" type="text" size="1" maxlength="2" value="<?php echo $dataarray[1]; ?>"/>
              -
            <input name="nudia" type="text" size="1" maxlength="2" value="<?php echo $dataarray[2]; ?>"/>
  	      (AAAA-MM-DD)
          </td>
        </tr>
  	<tr>
            <td> <label> Género: </label> </td>
    	
    	<td>
          <input <?php if($user->getGenero() == 'M')echo 'checked="checked"'; ?> type="radio" name="genero" value="M" id="genero_0" /> Masculino
    	  <input<?php if($user->getGenero() == 'F')echo 'checked="checked"'; ?>  type="radio" name="genero" value="F" id="genero_1" /> Feminino
  	</td>
        </tr>
        <tr>
  	  <td><label>Email:</label></td> 
          <td><input name="email" type="text" size="60" maxlength="100" value="<?php echo $user->getEmail(); ?>" /></td>
  	</tr>	
      </table>
     </fieldset>
	  	<p>    
    	<input type="submit" name="nusubmit" id="nusubmit" value="Actualizar" />
    	<br />
  	</p>
</form>
</fieldset>
