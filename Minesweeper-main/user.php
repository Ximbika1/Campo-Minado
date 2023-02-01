<?php
    session_start();
    include_once('connection.php');
    $conn;
    if(isset($_SESSION['userData'])){
        header("Location: index.php");
    }
    if(isset($_GET['user_id'])){
        $conn = openConnection();
        if($conn == NULL) return;
        $jsonResp = array('resp' => false);
        $user_id = urldecode(htmlspecialchars($_GET['user_id']));
        try{
            $res = $conn->query("select * from player where username = '$user_id'");
            if($res->fetch(PDO::FETCH_ASSOC)){
                $jsonResp['resp'] = true;
            }
            closeConnection($conn);
            echo json_encode($jsonResp);
        }catch(PDOException $error){
            echo json_encode(array('error' => $error->getMessage()));
        }
    }
    
?>