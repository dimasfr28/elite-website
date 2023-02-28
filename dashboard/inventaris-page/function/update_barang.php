<?php

$id_barang = $_GET["id_barang"];

$data = query("SELECT * FROM tb_inventory WHERE id_barang = $id_barang")[0];

function updateitem($data)
{
    global $conn;

    $id_barang = $data["id_barang"];
    $barang  = $data["barang"];
    $id_kategori  = $data["id_kategori"];
    $jumlah  = $data["jumlah"];
    $fotoLama  = $data["fotoLama"];

    if ($_FILES['foto']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        $foto = imgitem();
        $sql = "SELECT * FROM tb_inventory WHERE id_barang = '$id_barang'";
        $query = mysqli_query($conn, $sql);
        $execute = mysqli_fetch_assoc($query);
        if (file_exists("../../profile/" . $execute['foto']) && $foto != false) {
            unlink("./foto_item/" . $execute['foto']);
        }
    }

    $query = "UPDATE tb_inventory SET
                nama_barang = '$barang',
                id_kategori = '$id_kategori',
                jumlah = '$jumlah'";
    // WHERE id_barang = $id_barang
    //     ";

    if ($foto != false) {
        $query .= ", foto = '$foto'";
        echo "<script>
 		document.location.href = '../inventaris-page/';
 		</script>";
        $_SESSION['data-success'] = 'update';
    }
    $query .= " WHERE id_barang = $id_barang";

    mysqli_query($conn, $query);

    $_POST['input'] = null;
    return mysqli_affected_rows($conn);

}

function imgitem()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpname = $_FILES['foto']['tmp_name'];

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

        echo "<script>
 		document.location.href = '../inventaris-page/';
 		</script>";
        $_SESSION['data-success'] = 'update';
    }


    if ($ukuranFile > 100000000) {
        $_SESSION['data-success'] = 'ukuran';
        return false;
    }


    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpname, './foto_item/' . $namaFileBaru);

    return $namaFileBaru;
}
