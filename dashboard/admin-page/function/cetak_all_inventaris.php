<?php

include "../../../koneksi/conn.php";
include "session.php";
$select = mysqli_query($conn, "SELECT *, tb_peminjaman.id_user AS ids FROM tb_peminjaman LEFT JOIN tb_user ON tb_peminjaman.id_user = tb_user.id_user ORDER BY id_peminjaman ASC");
$p = mysqli_fetch_assoc($select);
$id = $p['id_peminjaman'];
$i = 1;

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
    <link href="./printinv.css" rel="stylesheet">
    <title>Report Peminjaman ELITE | ALL</title>
</head>

<body>
    <div class="head">
        <p class="smkn">SEKOLAH MENENGAH KEJURUAN NEGERI 2 SURABAYA</p>
        <p class="elite">ELECTRONIC INOVATION CENTER</p>
        <p class="elite1">Jalan. Tentara Geine Pelajar 26, Petemon, Kec. Sawahan, Surabaya, Jawa Timur 60252 Tlp. 031-5343708,</p>

        <p class="elite2">Fax. 0315475376 e-mail : smekda.surabaya@gmail.com</p>
        <hr>
    </div>
    <p>Laporan Peminjaman ELITE</p>
    <table>
    <tr>
            <th class="tr1">No</th>
            <th class="tr1">Peminjam</th>
            <th class="tr1">Tanggal Dipinjam</th>
            <th class="tr1">Barang</th>
            <th class="tr1">Jumlah</th>
            <th class="tr1">Status</th>
            <th class="tr1">Tanggal Dikembalikan</th>
        </tr>
        <?php
        foreach ($select as $key) {
            $id = $key["id_peminjaman"];
        ?>
        <tr>
                <td><?= $i++ ?></td>
                <td><?= $key["nama_lengkap"]; ?></td>
                <td><?= $key["tanggal_peminjaman"]; ?></td>
                <td>
                    <?php
                    $detail = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail LEFT JOIN tb_inventory ON tb_peminjaman_detail.id_barang = tb_inventory.id_barang WHERE tb_peminjaman_detail.id_peminjaman = $id");
                    foreach ($detail as $value) {
                    ?>
                        <ul>
                            <li><?= $value["nama_barang"]; ?></li>
                        </ul>
                    <?php
                    }
                    ?>
                </td>
                <td>
                    <?php
                    $jumlah = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail WHERE id_peminjaman = $id");
                    foreach ($jumlah as $jml) {
                    ?>
                        <ul>
                            <li><?= $jml["jumlah"]; ?></li>
                        </ul>
                    <?php
                    }
                    ?>
                </td>
                <td>
                    <?php
                    $status = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail LEFT JOIN tb_status_pengembalian ON tb_peminjaman_detail.id_status_p = tb_status_pengembalian.id_status_p WHERE tb_peminjaman_detail.id_peminjaman = $id");
                    foreach ($status as $dt) {
                    ?>
                        <ul>
                            <li><?= $dt["nama_status"]; ?></li>
                        </ul>
                    <?php
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    $kembali = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail WHERE id_peminjaman = $id");
                    foreach ($kembali as $val) {
                    ?>
                    <ul>
                        <li><?= $val["tanggal_kembali"]; ?></li>
                    </ul>
                    <?php
                    }
                    ?>
                </td>
        </tr>
        <?php } ?>
    </table>

</body>

</html>

<?php

$html = ob_get_contents();
$mpdf->WriteHTML($html);
ob_end_clean();
$mpdf->Output("Report_Peminjaman_ELITE_All.pdf", "D");
?>