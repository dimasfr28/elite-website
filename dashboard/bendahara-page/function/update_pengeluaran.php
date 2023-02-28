<?php

function updatep($data)
{
    global $conn;


    $deskripsi = $data["deskripsi"];
    $saldo  = $data["saldo"];
    $tanggal = date("j F Y");
    $finalmax = $data["finalmax"];
    $id_kas = $data["id_kas"];


    $sql = mysqli_query($conn, "UPDATE tb_kas_keluar SET
                    saldo = '$saldo',
                    deskripsi = '$deskripsi',
                    date = '$tanggal'
                    WHERE id_kas_keluar = $id_kas");
    echo "<script>
    document.location.href = '../bendahara-page/pengeluaran.php';
    </script>";
    $_SESSION['success'] = "update";
}
