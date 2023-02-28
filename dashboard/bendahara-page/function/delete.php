<?php
include "../../../koneksi/conn.php";
$id_kas = $_GET['id_kas_keluar'];

$sql = mysqli_query($conn, "SELECT * FROM tb_kas_keluar WHERE id_kas_keluar = $id_kas");
$execute = mysqli_fetch_assoc($sql);

unlink("../nota/" . $execute['nota']);

$abc = mysqli_query($conn, "DELETE FROM tb_kas_keluar WHERE id_kas_keluar = '$id_kas'");

if ($abc) {
    echo "<script>
    document.location.href = '../../bendahara-page/pengeluaran.php';
    </script>";
}
?>