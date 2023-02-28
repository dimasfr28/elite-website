<?php 


$pending = mysqli_query($conn, "SELECT *, tb_peminjaman_detail.jumlah AS jumlahP FROM tb_peminjaman_detail RIGHT JOIN tb_peminjaman ON tb_peminjaman.id_peminjaman = tb_peminjaman_detail.id_peminjaman LEFT JOIN tb_inventory ON tb_inventory.id_barang = tb_peminjaman_detail.id_barang LEFT JOIN tb_user ON tb_peminjaman.id_user = tb_user.id_user WHERE tb_peminjaman_detail.id_status_p = 1");

date_default_timezone_set('Asia/Jakarta');
$date = date("Y-m-d");
$id_d = @$_POST["id_detail"];
$id_p = @$_POST["id_peminjaman"];
if (@$id_p == null) {
}elseif ($id_p != null) {
        $update_d = "UPDATE tb_peminjaman_detail SET
        id_status_p = 2,
        tanggal_kembali = '$date'
        WHERE id_detail = $id_d";
        mysqli_query($conn, $update_d);
        return mysqli_affected_rows($conn);
    $select = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail WHERE id_peminjaman = $id_p AND id_status_p = 1 OR id_status_p = 0");
    $qry = mysqli_num_rows($select); 
    if ($select == 0) {
        $update_p = "UPDATE tb_peminjaman SET
                    id_status_p = 2,
                    tanggal_kembali = '$date'
                    WHERE id_peminjaman = $id_p
        ";
        header("location:../in_pending.php");
    }elseif ($select != 0) {
        header("location:../in_pending.php");
    }
}

?>