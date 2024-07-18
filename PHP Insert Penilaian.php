<?php
    session_start();

    include 'PHP Connect Database.php';
    try{
        $pdo = new PDO($dsn,$db_username,$db_password,$opt);

        $nama = $_SESSION['nama_pengunjung'];
        $q1_value = $_POST['q1'];
        $q2_value = $_POST['q2'];
        $q3_value = $_POST['q3'];
        $q4_value = $_POST['q4'];
        $q5_value = $_POST['q5'];

        $stmt = $pdo->prepare("INSERT INTO visitors(`nama`,`kemudahan`,`keramahan`,`efisiensi`,`kejelasan informasi`,`rekomendasi`) VALUES('$nama','$q1_value','$q2_value','$q3_value','$q4_value','$q5_value')");
        $stmt->execute();            
        $pdo = NULL;
        header("Location: finish.html");
        exit();
    }catch (PDOException $e){
        $errorMessage = $e->getMessage();
        echo "<script>alert('Terjadi kesalahan: $errorMessage');</script>";
    }
?>