<?php
include "../../function.php";
$id_barang = @$_GET['id_barang'];

$sql = "SELECT * FROM tb_inventory WHERE id_barang = '$id_barang'";
$query = mysqli_query($conn, $sql);
$execute = mysqli_fetch_assoc($query);

$inp = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail WHERE id_status_p = '2' OR id_status_p = '2'");
$inrow = mysqli_num_rows($inp);

if ($inrow == 0) {
    unlink("./foto_item/" . $execute['foto']);

    $abc = "DELETE FROM tb_inventory WHERE id_barang = '$id_barang' ";
    $query = mysqli_query($conn, $abc);

} elseif ($inrow != 0) {
    
}

?>
<meta http-equiv="refresh" content="0;url=./index.php" />