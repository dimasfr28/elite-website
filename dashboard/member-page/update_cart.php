<?php

include "../../function.php";
session_start();

$id_user = $_POST['id_user'];
$id_barang = $_POST['id_barang'];
$jumlahaw = $_POST['jumlah_awal'];

$jumlahA = $jumlahaw - 1;
if ($jumlahA == 0) {
    $_SESSION['error'] = 'kurang'; 
} elseif ($jumlahA > 0) {
    $query = "UPDATE tb_cart SET
        jumlah = '$jumlahA'
            WHERE id_barang = $id_barang AND id_user = $id_user
        ";
    mysqli_query($conn, $query);
}
echo "<script>
      document.location='./cart.php'
      </script>
      ";

