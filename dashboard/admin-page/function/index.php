<?php

$id = $_SESSION['login']['id_user'];

$tb_user = mysqli_query($conn, "SELECT * FROM tb_user LEFT JOIN tb_kelas ON tb_user.id_kelas = tb_kelas.id_kelas LEFT JOIN tb_role ON tb_user.id_role = tb_role.id_role WHERE tb_user.id_role = 2 OR tb_user.id_role = 3 OR tb_user.id_role = 4 OR tb_user.id_role = 5 OR tb_user.id_role = 1");

$tb_user_no = mysqli_query($conn, "SELECT * FROM tb_user LEFT JOIN tb_kelas ON tb_user.id_kelas = tb_kelas.id_kelas LEFT JOIN tb_role ON tb_user.id_role = tb_role.id_role WHERE NOT tb_user.id_user = $id");

$totaluser = mysqli_num_rows($tb_user);

//kas
$tb_kas = mysqli_query($conn, "SELECT SUM(saldo) FROM tb_kas_siswa");
$kas = mysqli_fetch_assoc($tb_kas);
$tb_kas_keluar = mysqli_query($conn, "SELECT SUM(saldo) FROM tb_kas_keluar");
$pengeluaran = mysqli_fetch_assoc($tb_kas_keluar);
$kas_implode = implode($kas);
$pengeluaran_i = implode($pengeluaran);

$total_saldo = $kas_implode - (int)$pengeluaran_i;


function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

//inventory
$tb_inventory = mysqli_query($conn, "SELECT * FROM tb_inventory");
$total_barang = mysqli_num_rows($tb_inventory);

//terpinjam 
$tb_peminjaman_detail = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail WHERE id_status_p = 0 OR id_status_p = 1");
$total_peminjaman = mysqli_num_rows($tb_peminjaman_detail);

//tanggal-cart
$grafik = mysqli_query($conn, "SELECT *, SUM(saldo) FROM tb_kas_siswa WHERE NOT saldo = 0 GROUP BY updated_at ORDER BY updated_at ASC LIMIT 7");

//pagination 
$batas = 10;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;
$data = mysqli_query($conn, "SELECT * FROM tb_user LEFT JOIN tb_kelas ON tb_user.id_kelas = tb_kelas.id_kelas LEFT JOIN tb_role ON tb_user.id_role = tb_role.id_role WHERE NOT tb_user.id_user = $id AND NOT tb_user.id_role = 6  AND NOT tb_user.id_role = 7 ");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);
$nomor = $halaman_awal + 1;
