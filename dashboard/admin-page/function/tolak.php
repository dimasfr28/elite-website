<?php
include "../../../koneksi/conn.php";
$id_user = @$_GET['id_user']; 
date_default_timezone_set('Asia/Jakarta');
$tanggal = date("Y-m-d");


$sql = "SELECT * FROM tb_user WHERE id_user = '$id_user'";
$query1 = mysqli_query($conn, $sql);
$execute = mysqli_fetch_assoc($query1);
unlink("../../../profile/" . $execute['image_profile']);


$query = "UPDATE tb_user SET
            id_role = '7',
            tanggal_daftar = '$tanggal'
            WHERE id_user = '$id_user'
";
mysqli_query($conn, $query);

$lama = 1; // lama data adalah 3 hari
 
// proses penghapusan data

    $delete = "DELETE FROM tb_user
          WHERE id_role = '7' AND DATEDIFF(CURDATE(), tanggal_daftar) > 1";
$delete1 = mysqli_query($conn, $delete);

?>
<meta http-equiv="refresh" content="0;url=../pendaftaran.php" />