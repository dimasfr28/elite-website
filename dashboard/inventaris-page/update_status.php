<?php 

include "../../function.php";

$detail = $_POST["id_detail"];
$id_peminjaman = $_POST["id_peminjaman"];
$jumlahA = $_POST["jumlah_awal"];
$input_j = $_POST["input_j"];
$id_barang = $_POST["id_barang"];

if ($jumlahA == $input_j) {
    $query = "UPDATE tb_peminjaman_detail SET 
    id_status_p = '1'
    WHERE id_detail = '$detail'
    ";
    mysqli_query($conn, $query);     
}elseif ($jumlahA != $input_j) {
   $pengurangan = $jumlahA - $input_j;
   $insert = "INSERT INTO tb_peminjaman_detail VALUES ('', '$id_peminjaman', '$id_barang', '$input_j', '1', '')";
   mysqli_query($conn, $insert);
   $query = "UPDATE tb_peminjaman_detail SET 
   jumlah = '$pengurangan'
   WHERE id_detail = '$detail'
   ";
   mysqli_query($conn, $query);
}



header("location:./return_items.php");
?>