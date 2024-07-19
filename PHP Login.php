<?php
    session_start();

    include 'PHP Connect Database.php';
    try{
        $pdo = new PDO($dsn,$db_username,$db_password,$opt);

        $loginusername = $_POST['username'];
        $loginPassword = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM pegawai WHERE username = '$loginusername' AND password = '$loginPassword'");
        $stmt->execute();

        if ($stmt->rowcount() > 0) {
            header("Location: beranda.php");
        } else {
            header("Location: index.html");
        }
        $pdo = NULL;
        exit();
    }
    catch (PDOException $e){
        header("#");
    }
?>