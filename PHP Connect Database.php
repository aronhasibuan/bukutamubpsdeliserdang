<?php
    $db_hostname = "localhost"; 
    $db_database = "bukutamubpsds";
    $db_username = "root";
    $db_password = ""; 
    $db_charset = "utf8mb4";
    $dsn = "mysql:host=$db_hostname;dbname=$db_database;charset=$db_charset";
    $opt = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    );
    $pdo = new PDO($dsn,$db_username,$db_password,$opt);
?>