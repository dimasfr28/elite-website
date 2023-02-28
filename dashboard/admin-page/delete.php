<?php
include "../../koneksi/conn.php";
session_start();
$id_user = @$_GET['id_user'];

$sql = "SELECT * FROM tb_user LEFT JOIN tb_kelas ON tb_user.id_kelas = tb_kelas.id_kelas WHERE id_user = '$id_user'";
$query = mysqli_query($conn, $sql);
$execute = mysqli_fetch_assoc($query);
// unlink("../../profile/" . $execute['image_profile']);

$nama_user = $execute['nama_lengkap'];
$kelas = $execute['nama_kelas'];
$pengganti_id = $execute['nama_lengkap'] . '(' . $execute['nama_kelas'] . ')';

$inkas = mysqli_query($conn, "SELECT * FROM tb_kas_siswa WHERE id_user = $id_user");
$kas = mysqli_fetch_assoc($inkas);

$id_kas = $kas['id_kas'];
$update = "UPDATE tb_kas_siswa SET
            id_user = '$pengganti_id'
            WHERE id_kas = $id_kas
            ";
$update_kas = mysqli_query($conn, $update);

$inP = mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE id_user = $id_user");

$p_row = mysqli_num_rows($inP);
if ($p_row == 0) {
    # code...
} elseif ($p_row != 0) {
    $peminjaman = mysqli_fetch_assoc($inP);
    $id_p = $peminjaman['id_peminjaman'];
    $update_p = "UPDATE tb_peminjaman SET
                    id_user = '$pengganti_id'
                    WHERE id_peminjaman = $id_p
                    ";
    $update_peminjaman = mysqli_query($conn, $update_p);
}





$abc = "DELETE FROM tb_user WHERE id_user = '$id_user' ";
$query = mysqli_query($conn, $abc);

?>

<meta http-equiv="refresh" content="0;url=../admin-page/" />