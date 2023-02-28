<?php

$grafik = mysqli_query($conn, "SELECT date FROM tb_kas_keluar GROUP BY date ORDER BY id_kas_keluar ASC LIMIT 7");
$grafiksaldo = mysqli_query($conn, "SELECT SUM(saldo) AS total FROM tb_kas_keluar GROUP BY date ORDER BY id_kas_keluar ASC LIMIT 7");

$kas = mysqli_query($conn, "SELECT * FROM tb_kas_siswa LEFT JOIN tb_user ON tb_user.id_user =  tb_kas_siswa.id_user");

date_default_timezone_set('Asia/Jakarta');
$tanggal = date("j F Y");

$user = mysqli_query($conn, "SELECT * FROM tb_user");
function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}




//pagination
$batas = 10;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
$previous = $halaman - 1;
$next = $halaman + 1;
$jumlah_data = mysqli_num_rows($kas);
$total_halaman = ceil($jumlah_data / $batas);
$nomor = $halaman_awal + 1;


$rowkas = mysqli_num_rows($kas);

if (isset($_POST['tambah_saldo'])) {

    if (updatesaldo($_POST) > 0) {
        
    } else {
        echo mysqli_error($conn);
    }
}
