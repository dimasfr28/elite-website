<?php

date_default_timezone_set('Asia/Jakarta');
$tanggal = date("j F Y");

$saldokas = mysqli_query($conn, "SELECT SUM(saldo) AS s_kas FROM tb_kas_siswa");
$saldopengeluaran = mysqli_query($conn, "SELECT SUM(saldo) AS s_keluar FROM tb_kas_keluar");
// $totalsaldo = $saldokas - $saldopengeluaran;
$assosk = mysqli_fetch_assoc($saldokas);
$assocp = mysqli_fetch_assoc($saldopengeluaran);
$implodekas = $assosk['s_kas'];
$implodep = $assocp['s_keluar'];
$saldototal = (int)$implodekas - (int)$implodep;


function pengeluaran($data)
{
    global $conn;

    $deskripsi = $data["deskripsi"];
    $saldo  = $data["saldo"];
    $tanggal = $data["tanggal"];

    $nota = nota();
    if (!$nota) {
        return false;
    }


    $querykas = mysqli_query($conn, "SELECT SUM(saldo) FROM tb_kas_siswa");
    $querykeluar = mysqli_query($conn, "SELECT SUM(saldo) FROM tb_kas_keluar");

    $row = mysqli_fetch_assoc($querykas);
    $klr = mysqli_fetch_assoc($querykeluar);
    $implodekas = implode($row);
    $implodepengeluaran = implode($klr);

    $hasilakhirkas = (int)$implodekas - (int)$implodepengeluaran;

    if ($hasilakhirkas < $saldo) { 
        $_SESSION['success'] = "pengeluaran";
    } elseif ($hasilakhirkas > $saldo) {
        $uplod = mysqli_query($conn, "INSERT INTO tb_kas_keluar VALUES ('', '$deskripsi', '$saldo', '$nota', '$tanggal')");
        echo "<script>
        document.location.href = '../bendahara-page/pengeluaran.php';
        </script>";
        $_SESSION['success'] = "berhasil";
    } elseif ($hasilakhirkas = $saldo) {
        $uplod = mysqli_query($conn, "INSERT INTO tb_kas_keluar VALUES ('', '$deskripsi', '$saldo', '$nota', '$tanggal')");
        
        echo "<script>
        document.location.href = '../bendahara-page/pengeluaran.php';
        </script>";
        $_SESSION['success'] = "berhasil";
    }

    return mysqli_affected_rows($conn);
}

function nota()
{
    $namaFile = $_FILES['nota']['name'];
    $ukuranFile = $_FILES['nota']['size'];
    $error = $_FILES['nota']['error'];
    $tmpname = $_FILES['nota']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                let notFile = confirm('pilih gambar terlebih dahulu');

                if (notFile){
                    location.replace('dashboard/page-admin/');
                }
            </script>";
    }
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $_SESSION['data-success'] = 'ekstensi';
        return false;
    }

    if (in_array($ekstensiGambar, $ekstensiGambarValid) && $ukuranFile < 100000000) {

        $_SESSION['data-success'] = 'success';
        echo "<script>
        document.location.href = '../bendahara-page/pengeluaran.php';
        </script>";
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    if ($ukuranFile > 100000000) {
        $_SESSION['data-success'] = 'ukuran';
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpname, './nota/' . $namaFileBaru);

    return $namaFileBaru;
}
