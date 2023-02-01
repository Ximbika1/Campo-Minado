<?php
	session_start();
	if(!isset($_SESSION['userData'])){
		header('Location: login.php');
   	}
	else{
		if(isset($_SESSION['message'])){
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		}
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta charset="UTF-8"/>
		<title>Editar suas informações pessoais</title>
	</head>
	<body>
		<header class="menu">
			<h1>Alterar dados do perfil:</h1>
			<img src="./images/bomb.svg" alt="Bomba">
		</header>
		<form action="attdados.php" method="post">
			<p>Nome<input name="name" type="text" placeholder="Nome Completo"/></p>
			<p>Email<input name="email" type="email" placeholder="exemplo.23@gmail.com"/></p>
			<p>Telefone<input name="telefone" type="text" placeholder="(DDD)00000 0000"/></p>
			<p>Senha nova<input name="pwd" type="password" placeholder="********"/></p>
			<p>Confirmar senha<input type="password" placeholder="********"/></p>
			<input type="submit" value="Confirmar">
		</form>
		<button class="cancel">Voltar</button>
		<footer>
		</footer>
		<script src="js/changeForm.js"></script>
	</body>
</html>
<?php
	}
?>
