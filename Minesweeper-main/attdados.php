<?php
    session_start();
    include_once('connection.php');
    if(!isset($_SESSION['userData'])){
         header('Location: login.php');
    }
    $getConnection = openConnection();
    if($getConnection == NULL){
        return;
    }
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['telefone']) && isset($_POST['pwd'])){
        if($_POST['name'] == '' || $_POST['email'] == '' || $_POST['telefone'] == '' || $_POST['pwd'] == ''){
            $_SESSION['message'] = '<script>alert("Todos os campos devem estar preenchidos!")</script>';
            header('Location: perfil.php'); 
        }
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $telefone = htmlspecialchars($_POST['telefone']);
        $pwd = md5($_POST['pwd']);
        try{
            $answer = $getConnection->exec("update player set senha='$pwd', nome='$name', telefone='$telefone', email='$email' where username='".$_SESSION['userData']['username']."'");
            if($answer > 0){
                $_SESSION['userData']['senha'] = $pwd;
                $_SESSION['userData']['nome'] = $name;
                $_SESSION['userData']['telefone'] = $telefone;
                $_SESSION['userData']['email'] = $email;
                $_SESSION['message'] = '<script>alert("Dados alterados com sucesso!")</script>';
                header('Location: perfil.php');
            }
            else{
                $_SESSION['message'] = '<script>alert("Não foi possível alterar os dados!")</script>';
                header('Location: perfil.php');
            }
        }
        catch(PDOException $erro){
            $_SESSION['message'] = '<script>alert("Não foi possível alterar os dados!\nVerifique se existe conexão com o banco de dados!")</script>';
            header('Location: perfil.php');
        }
    }
?>