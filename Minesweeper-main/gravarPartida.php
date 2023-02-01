<?php
    session_start();
    include_once('connection.php');
    $conn;
    // echo json_encode(array('test' => $_POST['resultado'].' '.$_POST['quadrados_restantes']));
    if(isset($_POST['resultado']) && isset($_POST['quadrados_restantes']) && isset($_POST['tempo']) && isset($_POST['modo']) && isset($_POST['id_board'])){

        $conn = openConnection();
        if($conn==NULL){
            return;
        }
        $jsonResp = array('message' => 'empty', 'error'=>false);
        $resultado =  $_POST['resultado'];
        $quadrados_restantes = $_POST['quadrados_restantes'];
        $tempo = $_POST['tempo'];
        $modo = $_POST['modo'];
        $board = $_POST['id_board'];
        try{
            $res = $conn->exec("insert into partida(resultado, quadrados_restantes, tempo, modo, id_board, id_player) values($resultado,$quadrados_restantes,$tempo,$modo, $board, '".$_SESSION['userData']['username']."') ");
            closeConnection($conn);
            if($res>0){
                $jsonResp['message'] = 'Partida cadastrada com sucesso!';
                echo json_encode($jsonResp);
            }
            else{
                $jsonResp['message'] = 'Não foi possível cadastrar partida';
                $jsonResp['error'] = true;
                echo json_encode($jsonResp);
            }
        }
        catch(PDOException $error){
            $jsonResp['message'] = $error->getMessage();
            $jsonResp['error'] = true;
            echo json_encode($jsonResp);
        }
    }
?>