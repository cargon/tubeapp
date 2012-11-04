
<?php defined( 'EXECUTA' ) or die( 'Acesso Negado' ); ?>

<fieldset class="fscontainer"><legend class="lgcontainer">Novo Utilizador</legend>

<form action="newuser.php" method="post" name="newuser" >

	<fieldset class="fscomponent"><legend class="lgcomponent">Dados de Autenticação</legend>
        <table>
  	<tr>
          <td> <label> Nome de Utilizador: </label> </td>
    	  <td><input name="login" type="text" size="30" maxlength="20" /></td>
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
    	  <td> <input type="text" name="nome" id="nunome" size="60" /> </td>
  	</tr>
        <tr>  
  	<td> <label>Data de Nascimento: </label> </td>
          <td> 
            <input name="nuano" type="text" size="3" maxlength="4" />
              - 
            <input name="numes" type="text" size="1" maxlength="2" />
              -
            <input name="nudia" type="text" size="1" maxlength="2" />
  	      (AAAA-MM-DD)
          </td>
        </tr>
  	<tr>
            <td> <label> Género: </label> </td>
    	
    	<td>
          <input type="radio" name="genero" value="M" id="genero_0" /> Masculino
    	  <input type="radio" name="genero" value="F" id="genero_1" /> Feminino
  	</td>
        </tr>
        <tr>
  	  <td><label>Email:</label></td> 
          <td><input name="email" type="text" size="60" maxlength="100" /></td>
  	</tr>	
      </table>
     </fieldset>
	  	<p>    
    	<input type="submit" name="nusubmit" id="nusubmit" value="Criar" />
    	<br />
  	</p>
</form>
</fieldset>
