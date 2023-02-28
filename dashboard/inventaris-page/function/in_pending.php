<?php

date_default_timezone_set('Asia/Jakarta');
$date = date("Y-m-d");
$id_d = @$_POST["id_detail"];
$id_p = @$_POST["id_peminjaman"];
if (@$id_p == null) {
} elseif ($id_p != null) {
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
        $update = mysqli_query($conn, $update_p);
        return $update;
        if ($update) {
            header('Location: ./in_pending.php');
            $_SESSION['confirm'] = 'sukses';
        }
        
    } elseif ($select != 0) {
    }
    
}

