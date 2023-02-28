<?php
$id_us = $_GET["id_user"];

$data = query("SELECT * FROM tb_user WHERE id_user = $id_us")[0];

$tb_user = query("SELECT tb_kelas.nama_kelas, tb_role.nama_role FROM tb_user LEFT JOIN tb_kelas ON tb_user.id_kelas = tb_kelas.id_kelas LEFT JOIN tb_role ON tb_user.id_role = tb_role.id_role");

function ubah($data)
{
    global $conn;

    $id_user = htmlspecialchars($data["id_user"]);
    $nama_lengkap  = htmlspecialchars($data["nama_lengkap"]);
    $passwordLama  = htmlspecialchars($data["passwordLama"]);
    $email  = htmlspecialchars($data["email"]);
    $password  = htmlspecialchars($data["password"]);
    $id_kelas  = htmlspecialchars($data["id_kelas"]);
    $id_role  = htmlspecialchars($data["id_role"]);
    $fotoLama  = htmlspecialchars($data["fotoLama"]);

    if ($password == null) {
        $inputp = $passwordLama;
    } elseif ($password != null) {
        $inputp = password_hash($password, PASSWORD_DEFAULT);
    }
    if ($_FILES['image_profile']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        $foto = uplodfoto();

        $sql = "SELECT * FROM tb_user WHERE id_user = '$id_user'";
        $query = mysqli_query($conn, $sql);
        $execute = mysqli_fetch_assoc($query);
        if (file_exists("../../profile/" . $execute['image_profile']) && $foto != false) {
            unlink("../../profile/" . $execute['image_profile']);
        }
    }
    $query = "UPDATE tb_user SET
                nama_lengkap = '$nama_lengkap',
                email = '$email',
                password = '$inputp',
                id_kelas = '$id_kelas',
                id_role = '$id_role'";

    if ($foto != false) {
        $query .= ", image_profile = '$foto'";
        $_SESSION['data-success'] = 'update';
    }
    $query .= "WHERE id_user = $id_user";
    mysqli_query($conn, $query);

    $_POST['update'] = null;
    return mysqli_affected_rows($conn);
}
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
        $_SESSION['data-success'] = 'update';
    }


    if ($ukuranFile > 100000000) {
        $_SESSION['data-success'] = 'ukuran';
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpname, '../../profile/' . $namaFileBaru);
    return $namaFileBaru;
}
