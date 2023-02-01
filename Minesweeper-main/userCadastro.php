<?php
    session_start();
    include_once('connection.php');
    $conn;
    if(isset($_SESSION['userData'])){
        header("Location: index.php");
    }

    if(isset($_POST['name']) && isset($_POST['user_id']) && isset($_POST['pwd']) && isset($_POST['email']) && isset($_POST['telefone']) && isset($_POST['cpf']) && isset($_POST['nasc']) ){

        $conn = openConnection();
        if($conn==NULL){
            return;
        }
        $jsonResp = array('resp' => false);
        $name =  htmlspecialchars($_POST['name']);
        $user_id = htmlspecialchars($_POST['user_id']);
        $pwd = md5($_POST['pwd']);
        $email = htmlspecialchars($_POST['email']);
        $telefone = htmlspecialchars($_POST['telefone']);
        $cpf = htmlspecialchars($_POST['cpf']);
        $nasc = htmlspecialchars($_POST['nasc']);
        try{
            $res = $conn->exec("insert into player values('$user_id','$pwd','$name','$nasc',$cpf,$telefone,'$email') ");
            closeConnection($conn);
            if($res>0){
                $_SESSION['message'] = "<script>alert('Usuário cadastrado com sucesso!')</script>";
                header('Location: login.php');
            }
            else{
                $_SESSION['message'] = "<script>alert('Não foi possível cadastrar usuário')</script>";
                header('Location: cadastro.php');
            }
        }
        catch(PDOException $error){
            echo json_encode(array('error' => $error->getMessage()));
            $_SESSION['message'] = "<script>alert('Não foi possível cadastrar usuário')</script>";
            header('Location: cadastro.php');
        }
    }



?>