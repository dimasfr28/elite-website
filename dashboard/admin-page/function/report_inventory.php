<?php 

$sql = mysqli_query($conn, "SELECT SUM(saldo) FROM tb_kas_siswa");
$query = mysqli_fetch_assoc($sql);
$implode = implode($query);

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
}
$i= 1;
$pengeluaran = mysqli_query($conn, "SELECT * FROM tb_kas_keluar");

//total saldo
$pengeluaran2 = mysqli_query($conn, "SELECT SUM(saldo) FROM tb_kas_keluar");
$saldo_p = mysqli_fetch_assoc($pengeluaran2);
$i_p = implode($saldo_p);
$total_kas = (int)$implode - (int)$i_p;

//date
date_default_timezone_set('Asia/Jakarta');
$tanggal = date("j F Y");
$mounth = date("F Y");


