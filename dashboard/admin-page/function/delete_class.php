<?php 
include "../../../koneksi/conn.php";
$id_kelas = @$_GET['id_kelas']; 

$abc = "DELETE FROM tb_kelas WHERE id_kelas = '$id_kelas' ";
$query = mysqli_query($conn, $abc);

?>

<meta http-equiv="refresh" content="0;url=../class_controll.php" />