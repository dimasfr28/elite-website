<?php 

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}


//tabel
$pengeluaran = mysqli_query($conn, "SELECT * FROM tb_kas_keluar");
$loopid = 1;

$batas = 10;
$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
$previous = $halaman - 1;
$next = $halaman + 1;
$jumlah_data = mysqli_num_rows($pengeluaran);
$total_halaman = ceil($jumlah_data / $batas);
$nomor = $halaman_awal+1;
?>