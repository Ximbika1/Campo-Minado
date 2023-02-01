<?php
	session_start();
	if(isset($_SESSION['message'])){
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
	if(isset($_SESSION['userData'])){
        header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta charset="UTF-8"/>
		<title>Login</title>
	</head>
	<body>
		<header class="menu">
			<nav>
				<p class="selected">Login</p>
				<div></div>
				<p class="alter-page">Cadastro</p>
			</nav>
			<img src="./images/bomb.svg" alt="Bomba">
		</header>
		<!--Usuario e Senha-->
		<form method="post" action="userLogin.php">
			<p>Usuário: <input type="text" name="user_id" placeholder="Username"/></p>
			<p>Senha: <input type="password" name="pwd" placeholder="********"/></p>
			<input type="submit" value="Acessar">
		</form>
		<!--Imagem Camuflado-->
		<footer>
		</footer>
		<script src="js/changeForm.js"></script>
	</body>
</html>