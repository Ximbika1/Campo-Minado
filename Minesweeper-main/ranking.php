<?php
	include_once("getBoards.php");
	if(!isset($_SESSION["userData"])){
		header("Location: login.php");
	}

	$conn = openConnection();
    try{
        $rankingList = array();
		foreach($_SESSION['boards'] as $board){
			$ranking = $conn->query("select c.id_player as username, c.modo as modo, min(c.tempo) as tempo from (select * from partida where resultado = 1 and partida.id_board = '".$board['codigo']."' and modo = 0) as c");
			if($user = $ranking->fetch(PDO::FETCH_ASSOC)){
				if($user['username'] != NULL)
					$rankingList[] = array_merge($user, $board);
			}
			$ranking = $conn->query("select c.id_player as username, c.modo as modo, min(c.tempo) as tempo from (select * from partida where resultado = 1 and partida.id_board = '".$board['codigo']."' and modo = 1) as c");
			if($user = $ranking->fetch(PDO::FETCH_ASSOC)){
				if($user['username'] != NULL)
					$rankingList[] = array_merge($user, $board);
			}
		}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Ranking Global</title>
		<!-- <meta name="viewport" content="width=device-width,initial-scale=1"> -->
		<link rel="stylesheet" href="css/ranking.css" type="text/css">
		<link rel="stylesheet" href="css/style.css" type="text/css">
	</head>
	<body>
		<button class="cancel">Voltar</button>
		<!--Titulo do ranking global com icon-->
		<div class="rank-title">
			<img src="./images/tropy.jpg" alt="Icone de troféu">
			<h2>Ranking Global</h2>
			<img src="./images/tropy.jpg" alt="Icone de troféu">
		</div>
		<!--Ranking-->
		<div class="rank-table">
			<table>
				<tr>
					<th>Usernames</th>
					<th>Dimensão</th>
					<th>Bombas</th>
					<th>Tempo</th>
					<th>Modo</th>
				</tr>
			<?php
				$counter = 1;
				foreach($rankingList as $player){
					if($player['modo']==1){
						$player['modo'] = "Rivotril";
					}
					else{
						$player['modo'] = "Normal";
					} 
					echo "<tr>";
					echo "<td>".$player['username']."</td>";
					echo "<td>".$player['coluna']."x".$player['linha']."</td>";
					echo "<td>".$player['bomba']."</td>";
					echo "<td>".$player['tempo']."</td>";
					echo "<td>".$player['modo']."</td>";
					echo "</tr>";
					$counter++;
				}
			?>
				<!-- <tr>
					<td>1</td>
					<td>Pedro23</td>
					<td>6</td>
					<td>6</td>
				</tr>
				<tr>
					<td>2</td>
					<td>Joao</td>
					<td>4</td>
					<td>4</td>
				</tr>
				<tr>
					<td>3</td>
					<td>Caio90</td>
					<td>4</td>
					<td>3</td>
				</tr>
				<tr>
					<td>4</td>
					<td>CainAbel</td>
					<td>5</td>
					<td>3</td>
				</tr>
				<tr>
					<td>5</td>
					<td>Ximbika</td>
					<td>7</td>
					<td>5</td>
				</tr>
				<tr>
					<td>6</td>
					<td>Richard</td>
					<td>9</td>
					<td>5</td>
				</tr>
				<tr>
					<td>7</td>
					<td>Antonio</td>
					<td>8</td>
					<td>7</td>
				</tr>
				<tr>
					<td>8</td>
					<td>Thomas</td>
					<td>6</td>
					<td>3</td>
				</tr>
				<tr>
					<td>9</td>
					<td>Name44</td>
					<td>20</td>
					<td>6</td>
				</tr>
				<tr>
					<td>10</td>
					<td>Kleytin</td>
					<td>9</td>
					<td>2</td>
				</tr> -->
			</table>
		</div>
		<!--Footer fundo-->
		<footer>
			<div class="footer-contet">
				<p>Copyright © 2021 Grupo 5</p>
			</div>
		</footer>
		<script src="js/changeForm.js"></script>
	</body>
</html>
<?php
	}
	catch(PDOException $error){
		echo json_encode(array('error' => $error->getMessage()));   
	}
?>