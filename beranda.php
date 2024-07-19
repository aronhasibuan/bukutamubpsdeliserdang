<?php
    // Connect to database
    $conn = mysqli_connect("localhost", "root", "", "bukutamubpsds");

    // Check connection
    if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
    }

    // Fetch data from database
    $sql = "SELECT * FROM visitors";
    $result = mysqli_query($conn, $sql);

    // Create arrays to store data
    $jenis_kelamin = array();
    $jenis_pekerjaan = array();
    $pendidikan = array();
    $kelompok_umur = array();
    $tujuan = array();
    $jumlah_harian = array();

    while ($row = mysqli_fetch_assoc($result)) {
    // Count jenis kelamin
    if ($row['jeniskelamin'] == 'Laki-laki') {
        $jenis_kelamin['Laki-laki'] = isset($jenis_kelamin['Laki-laki'])? $jenis_kelamin['Laki-laki'] + 1 : 1;
    } else {
        $jenis_kelamin['Perempuan'] = isset($jenis_kelamin['Perempuan'])? $jenis_kelamin['Perempuan'] + 1 : 1;
    }

    // Count jenis pekerjaan
    $jenis_pekerjaan[$row['pekerjaan']] = isset($jenis_pekerjaan[$row['pekerjaan']])? $jenis_pekerjaan[$row['pekerjaan']] + 1 : 1;

    // Count pendidikan
    $pendidikan[$row['pendidikan']] = isset($pendidikan[$row['pendidikan']])? $pendidikan[$row['pendidikan']] + 1 : 1;

    // Count kelompok umur
    $umur_group = floor($row['umur'] / 10) * 10; // group umur by 10-year range
    $kelompok_umur[$umur_group] = isset($kelompok_umur[$umur_group])? $kelompok_umur[$umur_group] + 1 : 1;

    // Count tujuan
    $tujuan[$row['manfaatkunjungan']] = isset($tujuan[$row['manfaatkunjungan']])? $tujuan[$row['manfaatkunjungan']] + 1 : 1;

    // Count jumlah harian
    $tanggal_berkunjung = date('Y-m-d', strtotime($row['tanggalberkunjung']));
    $jumlah_harian[$tanggal_berkunjung] = isset($jumlah_harian[$tanggal_berkunjung])? $jumlah_harian[$tanggal_berkunjung] + 1 : 1;
    }

    // Close database connection
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelayanan Statistik Terpadu BPS Kabupaten Deli Serdang</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="beranda.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
    <header id="header" class="header">
        <img class="logo" src="img/logobpsds.png" alt="BPS Kabupaten Deli Serdang" height="90" width="400">
        <a class="beranda" href="index.html">Logout</a>
    </header>
    <div class="content">
        <div class="title">Statistik Pelayanan PST BPS Kabupaten Deli Serdang</div>
        <div class="charts">
            <!-- Satu Baris ada 3 chart -->
            <!-- Pie Chart -->
            <div class="chart">
                <div class="chart-title-1">Jenis Kelamin</div>
                <div id="chart-1"></div>
                <script>
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart1);
                    function drawChart1() {
                        var data = google.visualization.arrayToDataTable([
                            ['Jenis Kelamin', 'Count'],
                            <?php foreach ($jenis_kelamin as $key => $value) {
                                echo "['$key', $value],";
                            }?>
                        ]);
                        var options = {
                            title: 'Jenis Kelamin',
                            pieHole: 0.4,
                        };
                        var chart = new google.visualization.PieChart(document.getElementById('chart-1'));
                        chart.draw(data, options);
                    }
                </script>
            </div>
            <!-- Bar Chart -->
            <div class="chart">
                <div class="chart-title-2">Jenis Pekerjaan</div>
                <div id="chart-2"></div>
                <script>
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart2);
                    function drawChart2() {
                        var data = google.visualization.arrayToDataTable([
                            ['Jenis Pekerjaan', 'Count'],
                            <?php foreach ($jenis_pekerjaan as $key => $value) {
                                echo "['$key', $value],";
                            }?>
                        ]);
                        var options = {
                            title: 'Jenis Pekerjaan',
                            legend: 'none',
                            
                        };
                        var chart = new google.visualization.BarChart(document.getElementById('chart-2'));
                        chart.draw(data, options);
                    }
                </script>
            </div>
            <!-- Bar Chart -->
            <div class="chart">
                <div class="chart-title-3">Pendidikan</div>
                <div id="chart-3"></div>
                <script>
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart3);
                    function drawChart3() {
                        var data = google.visualization.arrayToDataTable([
                            ['Pendidikan', 'Count'],
                            <?php foreach ($pendidikan as $key => $value) {
                                echo "['$key', $value],";
                            }?>
                        ]);
                        var options = {
                            title: 'Pendidikan',
                            legend: 'none',
                        };
                        var chart = new google.visualization.BarChart(document.getElementById('chart-3'));
                        chart.draw(data, options);
                    }
                </script>
            </div>
        </div>
        <div class="charts">
            <!-- Satu Baris ada 3 chart -->
            <!-- Bar Chart -->
            <div class="chart">
                <div class="chart-title-4">Kelompok Umur</div>
                <div id="chart-4"></div>
                <script>
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart4);
                    function drawChart4() {
                        var data = google.visualization.arrayToDataTable([
                            ['Umur', 'Count'],
                            <?php foreach ($kelompok_umur as $key => $value) {
                                echo "['$key', $value],";
                            }?>
                        ]);
                        var options = {
                            title: 'Kelompok Umur',
                            legend: 'none',
                        };
                        var chart = new google.visualization.BarChart(document.getElementById('chart-4'));
                        chart.draw(data, options);
                    }
                </script>
            </div>
            <!-- Bar Chart -->
            <div class="chart">
                <div class="chart-title-5">Tujuan</div>
                <div id="chart-5"></div>
                <script>
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart5);
                    function drawChart5() {
                        var data = google.visualization.arrayToDataTable([
                            ['Tujuan', 'Count'],
                            <?php foreach ($tujuan as $key => $value) {
                                echo "['$key', $value],";
                            }?>
                        ]);
                        var options = {
                            title: 'Tujuan',
                            legend: 'none',
                        };
                        var chart = new google.visualization.BarChart(document.getElementById('chart-5'));
                        chart.draw(data, options);
                    }
                </script>
            </div>
            <!-- Line Chart -->
            <div class="chart">
                <div class="chart-title-6">Jumlah Harian</div>
                <div id="chart-6"></div>
                <script>
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart6);
                    function drawChart6() {
                        var data = google.visualization.arrayToDataTable([
                            ['Tanggal', 'Count'],
                            <?php foreach ($jumlah_harian as $key => $value) {
                                echo "['$key', $value],";
                            }?>
                        ]);
                        var options = {
                            title: 'Jumlah Harian',
                            legend: 'none',
                        };
                        var chart = new google.visualization.LineChart(document.getElementById('chart-6'));
                        chart.draw(data, options);
                    }
                </script>
            </div>
        </div>
        <div class="table">
            <div class="table-title">Daftar Pengunjung PST Deli Serdang</div>
            <table class="histori-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Umur</th>
                        <th>No Telepon</th>
                        <th>Jenis Kelamin</th>
                        <th>Pendidikan Tertinggi</th>
                        <th>Pekerjaan</th>
                        <th>Instansi</th>
                        <th>Pemanfaatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $conn = mysqli_connect("localhost", "root", "", "bukutamubpsds");
                        $sql = "SELECT * FROM visitors ORDER BY tanggalberkunjung DESC";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['tanggalberkunjung']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['umur']; ?></td>
                        <td><?php echo $row['nomorhandphone']; ?></td>
                        <td><?php echo $row['jeniskelamin']; ?></td>
                        <td><?php echo $row['pendidikan'];?></td>
                        <td><?php echo $row['pekerjaan'];?></td>
                        <td><?php echo $row['namainstansi'];?></td>
                        <td><?php echo $row['manfaatkunjungan'];?></td>
                    </tr>
                    <?php
                        }
                        mysqli_close($conn);
                   ?>
                </tbody>
            </table>
        </div>

        <!-- Nanti lagi capek wkwkw -->
        <div class="table">
            <div class="table-title">Penilaian PST Deli Serdang</div>
            <table class="rating-table">
                <thead>
                    <tr>
                        <th>Aspek Penilaian</th>
                        <th>Rata-rata</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $conn = mysqli_connect("localhost", "root", "", "bukutamubpsds");
                    $sql = "SELECT 
                                AVG(kemudahan) AS rata_kemudahan,
                                AVG(keramahan) AS rata_keramahan,
                                AVG(efisiensi) AS rata_efisiensi,
                                AVG(kejelasan_informasi) AS rata_kejelasan_informasi,
                                AVG(rekomendasi) AS rata_rekomendasi
                            FROM evaluation";
                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                ?>
                    <tbody>
                        <tr>
                            <td>Kemudahan Prosedur/Alur Pelayanan</td>
                            <td><?php echo number_format($row['rata_kemudahan'], 2); ?></td>
                        </tr>
                        <tr>
                            <td>Keramahan dan Profesionalisme Staf</td>
                            <td><?php echo number_format($row['rata_keramahan'], 2); ?></td>
                        </tr>
                        <tr>
                            <td>Layanan PST Cepat dan Efisien</td>
                            <td><?php echo number_format($row['rata_efisiensi'], 2); ?></td>
                        </tr>
                        <tr>
                            <td>Kejelasan Informasi dan Bantuan yang Diberikan</td>
                            <td><?php echo number_format($row['rata_kejelasan_informasi'], 2); ?></td>
                        </tr>
                        <tr>
                            <td>Merekomendasikan Layanan PST</td>
                            <td><?php echo number_format($row['rata_rekomendasi'], 2); ?></td>
                        </tr>
                    </tbody>
                <?php
                    } else {
                        echo "Tidak ada data evaluasi.";
                    }
                    mysqli_close($conn);
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
