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
		<meta charset="UTF-8" />
		<title>Cadastro</title>
	</head>
	<body>
		<!-- Botoes de Login e Cadastro-->
		<header class="menu">
			<nav>
				<p class="alter-page">Login</p>
				<div class="selected"></div>
				<p class="selected">Cadastro</p>
			</nav>
			<img src="./images/bomb.svg" alt="Bomba">
		</header>
		<!--Campos do Cadastro-->
		<form method="post" action="userCadastro.php">
			<div class="columns">
				<p>Nome Completo <input type="text" name="name" placeholder="Nome Sobrenome"/></p>
				<p>Usuário <input name="user_id" type="text" placeholder="Username"/></p>
				<p>Senha <input type="password" name="pwd" placeholder="********"/> </p>
				<p>Email <input type="email" name="email" placeholder="exemplo@email.com"/></p>
				<p>Confirmar Senha <input type="password" placeholder="********"/></p>
				<p>Telefone <input type="text" class="preenchimento" name="telefone" placeholder="(DDD)00000 0000"/></p>
				<p>CPF <input type="number" class="preenchimento" name="cpf" placeholder="000.000.000-00"/></p>
				<p>Nascimento <input type="date" name="nasc" class="preenchimento"/></p>
			</div>
			<input class="botao" type="submit" value="Acessar">
		</form>
		<!--Imagem Camuflado-->
		<footer>
		</footer>
		<script src="js/changeForm.js"></script>
	</body>
</html>