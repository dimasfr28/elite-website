<?php 
include "../../function.php";
session_start();

$user_id = $_SESSION['login']['id_user'];

$select = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail LEFT JOIN tb_peminjaman ON tb_peminjaman.id_peminjaman = tb_peminjaman_detail.id_peminjaman WHERE tb_peminjaman.id_user = $user_id AND tb_peminjaman_detail.id_status_p = 1");

$assoc = mysqli_num_rows($select);

echo $assoc;