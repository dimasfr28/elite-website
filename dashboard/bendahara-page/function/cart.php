<?php 

function addpeminjaman($data)
{
    global $conn;

    $id_user = $data["id_user"];
    $id_barang = $data["id_barang"];
    $jumlah = $data["jumlah"];

    $result = mysqli_query($conn, "SELECT jumlah FROM tb_cart WHERE id_barang = '$id_barang' AND id_user = '$id_user'");
    $jumlah_barang = mysqli_query($conn, "SELECT jumlah FROM tb_inventory WHERE id_barang = '$id_barang'");
    $dipinjam = mysqli_query($conn, "SELECT SUM(jumlah) FROM tb_peminjaman_detail WHERE id_barang = $id_barang ORDER BY id_barang");

    $assoc = mysqli_fetch_assoc($jumlah_barang);
    $i_jumlah = implode($assoc);
    $assocp = mysqli_fetch_assoc($dipinjam);
    $pinjam = implode($assocp);
    $assocr = mysqli_fetch_assoc($result);
    $cart = implode($assocr);


    $tersedia = $i_jumlah - (int)$pinjam;


    if ($cart > $tersedia) {
        echo " <script>
        alert('Barang tidak tersedia');
        document.location.href = './';
        </script>
        ";
    } elseif ($cart < $tersedia) {
        if ($cart == null) {
            $insert = mysqli_query($conn, "INSERT INTO tb_cart VALUES('', '$id_user', '$id_barang', '$jumlah')");
            return ($insert);
        } elseif ($cart != null) {
            $tambah = $jumlah + 1;
            $update = "UPDATE tb_cart SET
            jumlah = $tambah
        WHERE id_barang = '$id_barang'
            ";
            return (mysqli_query($conn, $update));
        }
    }
}
