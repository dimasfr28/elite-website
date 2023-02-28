<?php 

$user_id = $_SESSION['login']['id_user'];

$select = mysqli_query($conn, "SELECT tb_peminjaman.id_user, tb_peminjaman.id_peminjaman, tb_peminjaman_detail.id_peminjaman, tb_peminjaman_detail.jumlah, tb_peminjaman_detail.id_barang FROM tb_peminjaman INNER JOIN tb_peminjaman_detail ON tb_peminjaman_detail.id_peminjaman = tb_peminjaman.id_peminjaman WHERE tb_peminjaman.id_user = $user_id");

$assoc = mysqli_fetch_assoc($select);


?>