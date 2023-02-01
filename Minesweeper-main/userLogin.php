<?php
    session_start();
    include_once('connection.php');
    $conn;
    if(isset($_SESSION['userData'])){
        header("Location: index.php");
    }
    function defSession($user){
        $_SESSION['userData'] = $user;
        header('Location: index.php');
    }

    if(isset($_POST['user_id']) && isset($_POST['pwd'])){
        
        $conn = openConnection();
        if($conn==NULL){
            return;
        }
        $user_id = htmlspecialchars($_POST['user_id']);
        $pwd = md5($_POST['pwd']);

        try{
            $res = $conn->query("select * from player where username = '$user_id' and senha='$pwd'");
            closeConnection($conn);
            $user = $res->fetch(PDO::FETCH_ASSOC);
            if($user){
                defSession($user);
            }
            else{
                $_SESSION['message'] = "<script>alert('Não foi possível encontrar usuário')</script>";
                header('Location: login.php');
            }
        }
        catch(PDOException $error){
            echo json_encode(array('error' => $error->getMessage()));
        }
    }




?>