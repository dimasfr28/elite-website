<?php

require_once "../../../mpdf_v8.0.3-master/vendor/autoload.php";

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
ob_start();
include "../../../koneksi/conn.php";
include "session.php";
include "report_kas.php";
$qry = mysqli_query($conn, "SELECT SUM(saldo) as saldos FROM tb_kas_siswa");
$qry_keluar = mysqli_query($conn, "SELECT SUM(saldo) as saldok FROM tb_kas_keluar");
$query = mysqli_fetch_assoc($qry);
$query_keluar = mysqli_fetch_assoc($qry_keluar);
$implode_qry = $query['saldos'];
$implode_qry_keluar = $query_keluar['saldok'];
$pengeluaran = (int)$implode_qry - (int)$implode_qry_keluar;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./print.css" rel="stylesheet">
    <title>Report Kas ELITE | ALL</title>
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
    <table>

        <tr>
            <th>Pendapatan</th>
            <th>Nilai</th>
        </tr>
        <tr>
            <td class="pem">Pemasukan Kas :</td>
            <td class="pem"><?= rupiah($implode_qry);  ?></td>
        </tr>
        <tr>
            <td class="tot">Total Pendapatan</td>
            <td class="tot"><?= rupiah($implode_qry);  ?></td>
        </tr>
        <tr>
            <th>Pengeluaran</th>
            <th>Nilai</th>
        </tr>
        <tr>
            <td class="pem">Total Pengeluaran :</td>
            <td class="pem"><?= rupiah($implode_qry_keluar);  ?></td>
        </tr>
        <tr>
            <th class="salhir1">Saldo Akhir :</th>
            <th class="salhir"><?= rupiah($pengeluaran); ?></th>
        </tr>
    </table>

</body>

</html>

<?php

$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($html);
$mpdf->Output("Report_Kas_ELITE_All.pdf", "D");
?>