<?php

include "../../function.php";
include "./function/session.php";


$user = $_POST["id_user"];

date_default_timezone_set('Asia/Jakarta');
$date = date("Y-m-d");

$sql = "INSERT INTO tb_peminjaman VALUES ('', '$date', '$user')";
$query = mysqli_query($conn, $sql);
$id_peminjaman =  mysqli_insert_id($conn);

$addtopeminjaman = mysqli_query($conn, "SELECT * FROM tb_cart WHERE id_user = $user");
$addtopeminjaman0 = mysqli_num_rows($addtopeminjaman);
if ($addtopeminjaman0 == 0) {
  $_SESSION['error'] = 'null';
  echo "<script>
      document.location='./cart.php'
      </script>
      ";
} elseif ($addtopeminjaman0 != 0) {
  foreach ($addtopeminjaman as $key) {
    $sql = "INSERT INTO tb_peminjaman_detail VALUES ('', '$id_peminjaman', " . $key['id_barang'] . ", " . $key['jumlah'] . ", '0', '--')";
    $query = mysqli_query($conn, $sql);
  }


  $delete = mysqli_query($conn, "DELETE FROM tb_cart WHERE id_user = $user");
  $_SESSION['pinjaman'] = "pinjam";
  if ($delete) {
    header('location: return_items.php');
  }
}
