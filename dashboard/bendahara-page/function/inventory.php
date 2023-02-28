<?php 

$grafik = mysqli_query($conn, "SELECT date FROM tb_kas_keluar GROUP BY date ORDER BY id_kas_keluar ASC LIMIT 7");
$grafiksaldo = mysqli_query($conn, "SELECT SUM(saldo) FROM tb_kas_keluar GROUP BY date ORDER BY id_kas_keluar ASC LIMIT 7");

//pagination
$batas = 8;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
$previous = $halaman - 1;
$next = $halaman + 1;

$inventory = mysqli_query($conn, "SELECT * FROM tb_inventory LIMIT $halaman_awal, $batas");
$inv = mysqli_query($conn, "SELECT * FROM tb_inventory");

$jumlah_data = mysqli_num_rows($inv);
$total_halaman = ceil($jumlah_data / $batas);
$nomor = $halaman_awal + 1;


date_default_timezone_set('Asia/Jakarta');
$tanggal = date("j F Y");

$user_id = $_SESSION['login']['id_user'];

$user = mysqli_query($conn, "SELECT * FROM tb_kas_siswa WHERE id_user = $user_id");
$saldouser = mysqli_fetch_array($user);

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

$notreturn = mysqli_query($conn, "SELECT tb_peminjaman.id_user, tb_peminjaman.id_peminjaman, tb_peminjaman_detail.id_peminjaman, tb_peminjaman_detail.jumlah, tb_peminjaman_detail.id_barang FROM tb_peminjaman INNER JOIN tb_peminjaman_detail ON tb_peminjaman_detail.id_peminjaman = tb_peminjaman.id_peminjaman WHERE tb_peminjaman_detail.id_status_p = 0 AND tb_peminjaman.id_user = $user_id");
$getnotreturn = mysqli_num_rows($notreturn);

$return = mysqli_query($conn, "SELECT tb_peminjaman.id_user, tb_peminjaman.id_peminjaman, tb_peminjaman_detail.id_peminjaman, tb_peminjaman_detail.jumlah, tb_peminjaman_detail.id_barang FROM tb_peminjaman INNER JOIN tb_peminjaman_detail ON tb_peminjaman_detail.id_peminjaman = tb_peminjaman.id_peminjaman WHERE tb_peminjaman_detail.id_status_p = 1 AND tb_peminjaman.id_user = $user_id");
$getreturn = mysqli_num_rows($notreturn);

// $belumdikembalikan = mysqli_query($conn)

$barang = mysqli_query($conn, "SELECT tb_inventory.id_barang, tb_inventory.jumlah, tb_inventory.nama_barang, tb_inventory.foto, tb_kategori_barang.id_kategori  FROM tb_inventory LEFT JOIN tb_kategori_barang ON tb_inventory.id_kategori =  tb_kategori_barang.id_kategori");
$hitungbarang = mysqli_num_rows($barang);

$peminjaman = mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE id_user = $user_id");
$peminjaman_pribadi = mysqli_num_rows($peminjaman);

$last_peminjaman = mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE id_user = $user_id GROUP BY id_peminjaman DESC LIMIT 1");
$last = mysqli_fetch_assoc($last_peminjaman);



if (isset($_POST['cart'])) {
    if (addcart($_POST) > 0) {
        header('location:./cart.php');
    } else {
        echo mysqli_error($conn);
    }
}

function addcart($data)
{
    global $conn;

    $id_user = $data["id_user"];
    $id_barang = $data["id_barang"];
    $jumlah = $data["jumlah"];
    
    $result = mysqli_query($conn, "SELECT jumlah, id_barang, id_user FROM tb_cart WHERE id_barang = '$id_barang' AND id_user = '$id_user'");
    $jumlah_barang = mysqli_query($conn, "SELECT jumlah AS jum FROM tb_inventory WHERE id_barang = '$id_barang'");
    $dipinjam = mysqli_query($conn, "SELECT SUM(jumlah) AS pinjam FROM tb_peminjaman_detail WHERE id_barang = $id_barang AND NOT id_status_p = 2 GROUP BY id_barang");

    $assoc = mysqli_fetch_assoc($jumlah_barang);
    $i_jumlah = $assoc["jum"];
    $assocp = mysqli_fetch_assoc($dipinjam);
    $pinjam = @$assocp['pinjam'];
    $assocr = mysqli_fetch_assoc($result);


    $tersedia = $i_jumlah - (int)$pinjam;

    if (@$assocr["jumlah"] == $tersedia) {
        $_SESSION['error'] = "tidakt";
    } elseif ($assocr["jumlah"] <= $tersedia) {
        if ($assocr["id_barang"] == null) {
            $insert = mysqli_query($conn, "INSERT INTO tb_cart VALUES('', '$id_user', '$id_barang', '$jumlah')");
            return ($insert);
        } elseif ($assocr["id_barang"] != null) {
            $tambah = $assocr["jumlah"] + 1;
            $update = "UPDATE tb_cart SET 
            jumlah = $tambah
            WHERE id_user = '$id_user' AND id_barang = '$id_barang'";
            header('location:./cart.php');
            return mysqli_query($conn, $update);
        }
    } 
    
}
