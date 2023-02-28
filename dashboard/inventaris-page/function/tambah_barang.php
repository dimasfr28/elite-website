<?php 

function inputitem($data)
{
    global $conn;

    $barang = $data["barang"];
    $id_kategori = $data["id_kategori"];
    $jumlah = $data["jumlah"];

    $imgitem = imgitem();
    if (!$imgitem) {
        return false;
    }

    $simpan = mysqli_query($conn, "INSERT INTO tb_inventory VALUES('', '$barang', '$id_kategori', '$jumlah', '$imgitem')");

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

        $_SESSION['data-success'] = 'addbarang';
        echo "<script>
        document.location.href = '../inventaris-page/';
        </script>";
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    if ($ukuranFile > 100000000) {
        $_SESSION['data-success'] = 'ukuran';
        return false;
    }

    move_uploaded_file($tmpname, './foto_item/' . $namaFileBaru);

    return $namaFileBaru;
}


?>