<?php 

//grafik
$grafik = mysqli_query($conn, "SELECT date FROM tb_kas_keluar GROUP BY date ORDER BY id_kas_keluar ASC LIMIT 7");
$grafiksaldo = mysqli_query($conn, "SELECT SUM(saldo) FROM tb_kas_keluar GROUP BY date ORDER BY id_kas_keluar ASC LIMIT 7");

date_default_timezone_set('Asia/Jakarta');
$tanggal = date("j F Y");

$user = mysqli_query($conn, "SELECT * FROM tb_user WHERE tb_user.id_role = 2 OR tb_user.id_role = 3 OR tb_user.id_role = 4 OR tb_user.id_role = 5 OR tb_user.id_role = 1");
$hitunguser = mysqli_num_rows($user);

$peminjaman = mysqli_query($conn, "SELECT * FROM tb_peminjaman");
$hitungpeminjaman = mysqli_num_rows($peminjaman);

// $belumdikembalikan = mysqli_query($conn)
$batas = 10;
$halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;	
$previous = $halaman - 1;
$next = $halaman + 1;
$barang = mysqli_query($conn, "SELECT tb_inventory.id_barang, tb_inventory.jumlah, tb_inventory.nama_barang, tb_inventory.foto, tb_kategori_barang.id_kategori  FROM tb_inventory LEFT JOIN tb_kategori_barang ON tb_inventory.id_kategori =  tb_kategori_barang.id_kategori");
$hitungbarang = mysqli_num_rows($barang);
$total_halaman = ceil($hitungbarang / $batas);
$nomor = $halaman_awal+1;

//not be restored
$selectr = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail WHERE id_status_p = 1 OR id_status_p = 0");
$restored = mysqli_num_rows($selectr);

?>