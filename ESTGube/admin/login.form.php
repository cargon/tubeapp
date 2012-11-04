<?php defined( 'EXECUTA' ) or die( 'Acesso Negado' ); ?>
<div id="logindiv">
<?php 
switch ($_GET['lgerror'])
{
	case 1: 
		echo 'Palavra-passe ou Nome de utilizador invalidos';
	break;
	case 2: 
		echo 'Por favor insira um nome de utilizador';
	break;
	case 3: 
		echo 'Não tem acesso a esta zona ou a sua conta foi desactivada';
	break;
}

?>
<table>
<form action="login.php" method="post">
<tr>
	<td>
	Nome de Utilizador:
	</td>
	<td>
    <input name="login" type="text" size="30" />
	</td>
</tr>
<tr>
	<td>
    Palavra-passe:
	</td>
	<td><input type="password" name="pass" size="30" />	</td>
</tr>
<tr>
	<td><input name="lgsubmit" type="submit" value="Entrar" />
	</td>
</tr>
</form>
</table>
</div>