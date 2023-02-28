<?php

include "../../function.php";
session_start();

$id_user = $_POST['id_user'];
$id_barang = $_POST['id_barang'];
$jumlahaw = $_POST['jumlah_awal'];

$jumlahA = $jumlahaw + 1;
$sql = mysqli_query($conn, "SELECT * FROM tb_inventory WHERE id_barang = $id_barang");
$sql2 = mysqli_query($conn, "SELECT SUM(jumlah) as dipinjam FROM tb_peminjaman_detail WHERE id_barang = $id_barang AND NOT id_status_p = 2");
$assoc = mysqli_fetch_assoc($sql);
$assoc2 = mysqli_fetch_assoc($sql2);
$sisa = $assoc['jumlah'] - (int)$assoc2['dipinjam'];
$in = $sisa - $jumlahaw;
if ($in == 0) {
    $_SESSION['error'] = 'lebih'; 
}elseif ($in > 0) {
    // echo 'y';
    // die;
    $query = "UPDATE tb_cart SET
        jumlah = '$jumlahA'
            WHERE id_barang = $id_barang AND id_user = $id_user
        ";
    $y = mysqli_query($conn, $query);
}
echo "<script>
document.location='./cart.php'
</script>
";


// elseif ($jumlahA == $sisa) {
//     // $query = "UPDATE tb_cart SET
//     //     jumlah = '$jumlahA'
//     //         WHERE id_barang = $id_barang AND id_user = $id_user
//     //     ";
//     // mysqli_query($conn, $query);
//     echo 'kontol';
//     die;
// }


