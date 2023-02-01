<?php
    session_start();
    include_once('connection.php');
    $conn = openConnection();
    try{
        $boardList = array();
        $resp = $conn->query('select * from board order by codigo desc');
        while($board = $resp->fetch(PDO::FETCH_ASSOC)){
            $boardList[] = $board;
        }
        $_SESSION['boards'] = $boardList;
    }catch(PDOException $error){
        echo json_encode(array('error' => $error->getMessage()));
    }
?>