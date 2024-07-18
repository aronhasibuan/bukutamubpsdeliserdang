<?php
    session_start();

    if (isset($_REQUEST['nama']))
    $_SESSION['nama_pengunjung'] = $_REQUEST['nama'];

    include 'PHP Connect Database.php';
    try{
        $pdo = new PDO($dsn,$db_username,$db_password,$opt);

        $nama = $_SESSION['nama_pengunjung'];
        $email = $_POST['email'];
        $umur = $_POST['age'];
        $nomorhandphone = $_POST['phone'];
        $jeniskelamin = $_POST['gender'];
        $pendidikan = $_POST['education'];
        $pekerjaan = $_POST['job'];
        $namainstansi = $_POST['instansi'];
        $manfaatkunjungan = $_POST['goals'];
        $tanggalberkunjung = date("Y-m-d");

        $stmt = $pdo->prepare("INSERT INTO visitors(`nama`,`email`,`umur`,`nomorhandphone`,`jeniskelamin`,`pendidikan`,`pekerjaan`,`namainstansi`,`manfaatkunjungan`,`tanggalberkunjung`) VALUES('$nama','$email','$umur','$nomorhandphone','$jeniskelamin','$pendidikan','$pekerjaan','$namainstansi','$manfaatkunjungan','$tanggalberkunjung')");
        $stmt->execute();            
        $pdo = NULL;
        header("Location: form2.html");
        exit();
    }catch (PDOException $e){
        $errorMessage = $e->getMessage();
        echo "<script>alert('Terjadi kesalahan: $errorMessage');</script>";
    }
?>