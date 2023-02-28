<?php 

$user_id = $_SESSION['login']['id_user'];

$select = mysqli_query($conn, "SELECT tb_peminjaman.id_user, tb_peminjaman.id_peminjaman, tb_peminjaman_detail.id_peminjaman, SUM(tb_peminjaman_detail.jumlah) as Jml, tb_peminjaman_detail.id_barang FROM tb_peminjaman LEFT JOIN tb_peminjaman_detail ON tb_peminjaman_detail.id_peminjaman = tb_peminjaman.id_peminjaman WHERE NOT tb_peminjaman_detail.id_status_p = 2 GROUP BY tb_peminjaman_detail.id_barang");

$assoc = mysqli_fetch_assoc($select);


?>