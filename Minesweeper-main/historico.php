<?php
    session_start();
    include_once('connection.php');
    if(!isset($_SESSION['userData'])){
        header("Location: login.php");
    }
    $conn = openConnection();
    try{
        $partidaList = array();
        $his = $conn->query("select * from partida inner join board on board.codigo= partida.id_board and partida.id_player  = '".$_SESSION['userData']['username']."' order by partida.codigo asc");
        while($partida=$his->fetch(PDO::FETCH_ASSOC)){
            if($partida['resultado']==1){
                $partida['resultado'] = "Vitoria";
            }
            else{
                $partida['resultado'] = "Derrota";
            }
            if($partida['modo']==1){
                $partida['modo'] = "Rivotril";
            }
            else{
                $partida['modo'] = "Normal";
            } 
            $partidaList[]=$partida;
        }
        echo json_encode($partidaList);
    }
    catch(PDOException $error){
        echo json_encode(array('error' => $error->getMessage()));   
    }
?>