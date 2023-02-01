<?php
    function openConnection(){
        $sname = "localhost";
        $uname = "root";
        $pwd = "";
        $conn;
        try{
            $conn = new PDO("mysql:host=$sname;dbname=minesweeper", $uname, $pwd);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(PDOException $e){
            echo json_encode(array('error' => $e->getMessage()));
            return NULL;
        }
    }
    function closeConnection(&$conn){
        $conn = NULL;
    }
?>