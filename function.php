<?php

include "koneksi/conn.php";

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function addpost($data)
{
    global $conn;

    $judul = $data["judul"];
    $tgl_post = $data["tgl_post"];
    $id_kategori = $data["id_kategori"];
    $deskripsi = $data["deskripsi"];

    $imgpost = imgpost();
    if (!$imgpost) {
        return false;
    }

    $simpan = mysqli_query($conn, "INSERT INTO tb_post VALUES('', '$judul', '$deskripsi', '$imgpost', '$id_kategori', '$tgl_post')");

    return mysqli_affected_rows($conn);
}

function imgpost()
{
    $namaFile = $_FILES['image_post']['name'];
    $ukuranFile = $_FILES['image_post']['size'];
    $error = $_FILES['image_post']['error'];
    $tmpname = $_FILES['image_post']['tmp_name'];

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
        echo "<script>
                alert('file tidak terbaca');
            </script>";
        return false;
    }
    if ($ukuranFile > 100000000) {
        echo "<script>
                alert('file terlalu besar');
            </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpname, '../../imgpost/' . $namaFileBaru);

    return $namaFileBaru;
}

function updatepost($data)
{
    global $conn;

    $id_post = htmlspecialchars($data["id_post"]);
    $judul  = htmlspecialchars($data["judul"]);
    $deskripsi  = $data["deskripsi"];
    $id_kategori  = htmlspecialchars($data["id_kategori"]);
    $tgl_post  = htmlspecialchars($data["tgl_post"]);
    $fotoLama  = htmlspecialchars($data["fotoLama"]);

    if ($_FILES['image_post']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        $sql = "SELECT * FROM tb_post WHERE id_post = '$id_post'";
        $query = mysqli_query($conn, $sql);
        $execute = mysqli_fetch_assoc($query);
        unlink("../../imgpost/" . $execute['image_post']);
        $foto = imgpost();
    }

    $query = "UPDATE tb_post SET
                judul = '$judul',
                deskripsi = '$deskripsi',
                image_post = '$foto',
                id_kategori = '$id_kategori',
                tgl_post = '$tgl_post'

            WHERE id_post = $id_post
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updatesaldo($data)
{
    global $conn;


    $id_kas = $data["id_kas"];
    $saldotambah  = $data["saldotambah"];
    $saldo  = $data["saldo"];
    $tanggal = $data["tanggal"];

    $P_saldo = $saldotambah * 5000;
    $saldoakhir = (int)$saldo + $P_saldo;

    if ($saldoakhir <= 0) {
        $_SESSION['success'] = "minus";
        return false;
    } elseif ($saldoakhir > 0) {
        $_SESSION['success'] = "sukses";
        $query = mysqli_query($conn, "UPDATE tb_kas_siswa SET
        saldo = '$saldoakhir',
        updated_at = '$tanggal'
    WHERE id_kas = '$id_kas'
        ");
        return $query;
    }
}




// function rupiah($angka)
// {

//     $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
//     return $hasil_rupiah;
// }

// function inputitem($data)
// {
//     global $conn;

//     $barang = $data["barang"];
//     $id_kategori = $data["id_kategori"];
//     $jumlah = $data["jumlah"];

//     $imgitem = imgitem();
//     if (!$imgitem) {
//         return false;
//     }

//     $simpan = mysqli_query($conn, "INSERT INTO tb_inventory VALUES('', '$barang', '$id_kategori', '$jumlah', '$imgitem')");

//     if ($simpan) {
//         echo "
// 				<script>
// 					alert('Tersimpan');
// 				</script>
// 			";
//         echo "<meta http-equiv='refresh' content='0'>";
//     } else {
//         echo "
// 				<script>
// 					alert('Gagal Tersimpan');
// 				</script>
// 			";
//     }

//     return mysqli_affected_rows($conn);
// }

// function imgitem()
// {
//     $namaFile = $_FILES['foto']['name'];
//     $ukuranFile = $_FILES['foto']['size'];
//     $error = $_FILES['foto']['error'];
//     $tmpname = $_FILES['foto']['tmp_name'];

//     if ($error === 4) {
//         echo "<script>
//                 let notFile = confirm('pilih gambar terlebih dahulu');

//                 if (notFile){
//                     location.replace('dashboard/page-admin/');
//                 }
//             </script>";
//     }
//     $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
//     $ekstensiGambar = explode('.', $namaFile);
//     $ekstensiGambar = strtolower(end($ekstensiGambar));
//     if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
//         echo "<script>
//                 alert('file tidak terbaca');
//             </script>";
//         return false;
//     }



//     if ($ukuranFile > 100000000) {
//         echo "<script>
//                 alert('file terlalu besar');
//             </script>";
//         return false;
//     }

//     $namaFileBaru = uniqid();
//     $namaFileBaru .= '.';
//     $namaFileBaru .= $ekstensiGambar;

//     move_uploaded_file($tmpname, './foto_item/' . $namaFileBaru);

//     return $namaFileBaru;
// }

// function updateitem($data)
// {
//     global $conn;

//     $id_barang = $data["id_barang"];
//     $barang  = $data["barang"];
//     $id_kategori  = $data["id_kategori"];
//     $jumlah  = $data["jumlah"];
//     $fotoLama  = $data["fotoLama"];

//     if ($_FILES['foto']['error'] === 4) {
//         $foto = $fotoLama;
//     } else {
//         $sql = "SELECT * FROM tb_inventory WHERE id_barang = '$id_barang'";
//         $query = mysqli_query($conn, $sql);
//         $execute = mysqli_fetch_assoc($query);
//         unlink("./foto_item/" . $execute['foto']);
//         $foto = imgitem();
//     }

//     $query = "UPDATE tb_inventory SET
//                 nama_barang = '$barang',
//                 id_kategori = '$id_kategori',
//                 jumlah = '$jumlah',
//                 foto = '$foto'
//             WHERE id_barang = $id_barang
//                 ";

//     mysqli_query($conn, $query);

//     return mysqli_affected_rows($conn);
// }


// function addpeminjaman($data)
// {
//     global $conn;

//     $id_user = $data["id_user"];
//     $id_barang = $data["id_barang"];
//     $jumlah = $data["jumlah"];

//     $result = mysqli_query($conn, "SELECT jumlah FROM tb_cart WHERE id_barang = '$id_barang' AND id_user = '$id_user'");
//     $jumlah_barang = mysqli_query($conn, "SELECT jumlah FROM tb_inventory WHERE id_barang = '$id_barang'");
//     $dipinjam = mysqli_query($conn, "SELECT SUM(jumlah) FROM tb_peminjaman_detail WHERE id_barang = $id_barang ORDER BY id_barang");

//     $assoc = mysqli_fetch_assoc($jumlah_barang);
//     $i_jumlah = implode($assoc);
//     $assocp = mysqli_fetch_assoc($dipinjam);
//     $pinjam = implode($assocp);
//     $assocr = mysqli_fetch_assoc($result);
//     $cart = implode($assocr);


//     $tersedia = $i_jumlah - (int)$pinjam;


//     if ($cart > $tersedia) {
//         echo " <script>
//         alert('Barang tidak tersedia');
//         document.location.href = './';
//         </script>
//         ";
//     } elseif ($cart < $tersedia) {
//         if ($cart == null) {
//             $insert = mysqli_query($conn, "INSERT INTO tb_cart VALUES('', '$id_user', '$id_barang', '$jumlah')");
//             return ($insert);
//         } elseif ($cart != null) {
//             $tambah = $jumlah + 1;
//             $update = "UPDATE tb_cart SET
//             jumlah = $tambah
//         WHERE id_barang = '$id_barang'
//             ";
//             return (mysqli_query($conn, $update));
//         }
//     }
// }

// function updatecart($data)
// {
//     global $conn;

//     $id_barang = $data["id_barang"];
//     $jumlah  = $data["jumlah"];
//     $id_user  = $data["id_user"];

//     $tb_inventory = mysqli_query($conn, "SELECT jumlah FROM tb_inventory WHERE id_barang = $id_barang");
//     $tb_cart = mysqli_query($conn, "SELECT jumlah FROM tb_cart WHERE id_barang = $id_barang AND id_user = $id_user");

//     $associ = mysqli_fetch_assoc($tb_inventory);
//     $assocc = mysqli_fetch_assoc($tb_cart);
//     $i_inventory = implode($associ);
//     $i_cart = implode($assocc);
//     $tambah = $i_cart + $jumlah;
//     if ($jumlah == $i_cart) {
//         echo " <script>
//         alert('Input kan sesuatu');
//         </script>
//         ";
//     } elseif ($tambah > $i_inventory) {
//         echo " <script>
//             alert('Stok Barang Tidak Mencukupi');
//             </script>
//             ";
//     } elseif ($tambah < $i_inventory) {
//         $query = "UPDATE tb_cart SET
//                 jumlah = '$jumlah'
//             WHERE id_barang = $id_barang AND id_user = $id_user
//                 ";
//         mysqli_query($conn, $query);
//     } elseif ($tambah == $i_inventory) {
//         $query = "UPDATE tb_cart SET
//             jumlah = '$jumlah'
//         WHERE id_barang = $id_barang AND id_user = $id_user
//             ";
//         mysqli_query($conn, $query);
//     }
// }
function updatestatus($data)
{
    global $conn;
    $id_peminjaman_d  = $data["id_detail"];

    $query = "UPDATE tb_peminjaman_detail SET 
                                    id_status_p = '1',
                                    WHERE id_detail = '$id_peminjaman_d'
                            ";
    mysqli_query($conn, $query);
}

function yourprofile($data)
{
    global $conn;

    $id_user = htmlspecialchars($data["id_user"]);
    $nama_lengkap  = htmlspecialchars($data["nama_lengkap"]);
    $email  = htmlspecialchars($data["email"]);
    $password  = $data["password"];
    $password_lama  = $data["password_lama"];
    $id_kelas  = htmlspecialchars($data["id_kelas"]);

    $fotoLama  = htmlspecialchars($data["fotoLama"]);

    if ($password == null) {
        $inputp = $password_lama;
    } elseif ($password != null) {
        $inputp = password_hash($password, PASSWORD_DEFAULT);
    }
    if ($_FILES['image_profile']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        $foto = uplodfotosolo();

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
                id_kelas = '$id_kelas'";

    if ($foto != false) {
        $query .= ", image_profile = '$foto'";
        $_SESSION['data-success'] = 'success';
        echo "<script>
        document.location.href = './profile.php';
        </script>";
    }
    $query .= "WHERE id_user = $id_user";
    mysqli_query($conn, $query);

    $_POST['update'] = null;
    return mysqli_affected_rows($conn);
}
function uplodfotosolo()
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
        document.location.href = './profile.php';
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
