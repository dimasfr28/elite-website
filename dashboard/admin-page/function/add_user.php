<?php

function uplodfoto()
{
    $namaFile = $_FILES['image_profile']['name'];
    $ukuranFile = $_FILES['image_profile']['size'];
    $error = $_FILES['image_profile']['error'];
    $tmpname = $_FILES['image_profile']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                let notFile = confirm('pilih gambar terlebih dahulu');

                if (notFile){
                    location.replace('tambah.php');
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
        document.location.href = '../admin-page/';
        </script>";
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    if ($ukuranFile > 100000000) {
        $_SESSION['data-success'] = 'ukuran';
        return false;
    }
    move_uploaded_file($tmpname, '../../profile/' . $namaFileBaru);

    return $namaFileBaru;
}

function registrasi($data)
{
    global $conn;

    $nama_lengkap = stripslashes($data["nama_lengkap"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $email = strtolower(stripslashes($data["email"]));
    $id_role = $data["id_role"];
    $id_kelas = $data["id_kelas"];
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date("j F Y");
    $daftaru = date("Y-m-d");

    $sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
    $query = mysqli_fetch_assoc($sql);
    if ($query != null) {
        $_SESSION['data-success'] = 'email';
        return false;
    } elseif ($query == null) {
        $foto = uplodfoto();
    if (!$foto) {
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $simpan = mysqli_query($conn, "INSERT INTO tb_user VALUES('', '$nama_lengkap', '$foto', '$email', '$id_kelas', '$id_role', '$password', '$daftaru')");


    $selectid = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
    $id = mysqli_fetch_assoc($selectid);
    $iduser = $id["id_user"];

    $inputkas = mysqli_query($conn, "INSERT INTO tb_kas_siswa VALUES('', '$iduser', '0', '$tanggal')");
    return $inputkas;
    }

   
}
