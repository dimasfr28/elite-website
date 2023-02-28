<?php
include "../../koneksi/conn.php";

$id_cart = @$_GET['id_cart'];

$sql = "SELECT * FROM tb_cart WHERE id_cart = '$id_cart'";
$query = mysqli_query($conn, $sql);

$abc = "DELETE FROM tb_cart WHERE id_cart = '$id_cart' ";
$query = mysqli_query($conn, $abc);

if ($query) {
    echo "<script>Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Are You Not Admin!'
      });</script>";
      header("location:./cart.php");
} else {
    echo "<script>alert('Hapus Gagal..');</script>";
}


echo '
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

