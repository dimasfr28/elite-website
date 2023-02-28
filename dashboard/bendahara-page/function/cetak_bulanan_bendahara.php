<?php

include "../../../koneksi/conn.php";
include "session.php";
include "report_kas.php";
date_default_timezone_set('Asia/Jakarta');
$date = date("F Y");
$qry = mysqli_query($conn, "SELECT SUM(saldo) AS kas_S FROM tb_kas_siswa");
$qry_keluar = mysqli_query($conn, "SELECT SUM(saldo) AS kas_k FROM tb_kas_keluar WHERE NOT date LIKE '%$date%'");
$query = mysqli_fetch_assoc($qry);
$query_keluar = mysqli_fetch_assoc($qry_keluar);
$implode_qry = $query['kas_S'];
$implode_qry_keluar = $query_keluar['kas_k'];
$tot_kel = mysqli_query($conn, "SELECT SUM(saldo) as kel FROM tb_kas_keluar");
$kel = mysqli_fetch_assoc($tot_kel);
$pengeluaran = (int)$implode_qry;
$akhir = $pengeluaran- (int)$kel['kel'];


require_once "../../../mpdf_v8.0.3-master/vendor/autoload.php";

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
ob_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./print.css" rel="stylesheet">
    <title>Report Kas ELITE | <?php
                                $mount = date('F Y');
                                echo $mount;
                                ?></title>
</head>

<body>
    <div class="head">
        <p class="smkn">SEKOLAH MENENGAH KEJURUAN NEGERI 2 SURABAYA</p>
        <p class="elite">ELECTRONIC INOVATION CENTER</p>
        <p class="elite1">Jalan. Tentara Geine Pelajar 26, Petemon, Kec. Sawahan, Surabaya, Jawa Timur 60252 Tlp. 031-5343708,</p>

        <p class="elite2">Fax. 0315475376 e-mail : smekda.surabaya@gmail.com</p>
        <hr>
    </div>
    <p>Laporan Kas ELITE</p>
    <p class="date"><?= $date ?></p>
    <table>
        <tr>
            <th class="tr1"><b>Pendapatan</th>
            <th class="tr1"><b>Nilai</th>
        </tr>
        <tr>
            <td class="pem">Pemasukan Siswa :</td>
            <td class="pem"><?= rupiah($implode_qry);  ?></td>
        </tr>
        <tr>
            <td class="tot">Total Pendapatan</td>
            <td class="tot"><?= rupiah($implode_qry);  ?></td>
        </tr>
        <tr>
            <th><b>Pengeluaran</td>
            <th><b>Nilai</th>
        </tr>
        <tr>
            <td class="seb">Total Pengeluaran Sebelumnya:</td>
            <td class="seb"><?= rupiah($implode_qry_keluar);  ?></td>
        </tr>
        <tr>
            <th class="tr2"><b>Pengeluaran Bulan Ini</td>
            <th class="tr2"><b>Nilai</th>
        </tr>
        <?php
        $inmounth = mysqli_query($conn, "SELECT * FROM tb_kas_keluar WHERE date LIKE '%$date%'");
        foreach ($inmounth as $key) {
        ?>
            <tr>
                <td class="pem"><?= $key['deskripsi'] ?></td>
                <td class="pem"><?= rupiah($key['saldo']);  ?></td>
            </tr>
        <?php
        }
        ?>
         <tr>
            <th class="salhir1">Saldo Akhir :</th>
            <th class="salhir"><?= rupiah($akhir);?></th>
        </tr>
    </table>

</body>

</html>

<?php
$html = ob_get_contents();
$mpdf->WriteHTML($html);
ob_end_clean();
$mpdf->Output("Report_Kas_ELITE_" . $mount . ".pdf", "D");
?>