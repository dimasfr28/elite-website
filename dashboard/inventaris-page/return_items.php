<?php
include "../../function.php";
include "./function/session.php";

//grafik
$grafik = mysqli_query($conn, "SELECT date FROM tb_kas_keluar GROUP BY date ORDER BY id_kas_keluar ASC LIMIT 7");
$grafiksaldo = mysqli_query($conn, "SELECT SUM(saldo) FROM tb_kas_keluar GROUP BY date ORDER BY id_kas_keluar ASC LIMIT 7");

date_default_timezone_set('Asia/Jakarta');
$tanggal = date("j F Y");

$user_id = $_SESSION['login']['id_user'];



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

$detail_peminjaman = mysqli_query($conn, "SELECT tb_peminjaman_detail.id_detail, tb_peminjaman_detail.id_barang, tb_peminjaman.tanggal_peminjaman, tb_peminjaman_detail.id_peminjaman, tb_peminjaman_detail.jumlah AS jmlhD, tb_peminjaman_detail.id_status_p, tb_inventory.id_barang, tb_inventory.jumlah, tb_inventory.nama_barang, tb_inventory.foto, tb_peminjaman.id_user, tb_peminjaman.id_peminjaman FROM tb_peminjaman_detail LEFT JOIN tb_inventory ON tb_inventory.id_barang = tb_peminjaman_detail.id_barang LEFT JOIN tb_peminjaman ON tb_peminjaman.id_peminjaman = tb_peminjaman_detail.id_peminjaman WHERE tb_peminjaman_detail.id_status_p = 0 AND tb_peminjaman.id_user = $user_id");

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

if (isset($_POST['update'])) {
    if (updatestatus($_POST) > 0) {
        
    } else {
        echo mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../template/head.php"; ?>
    <title>Dashboard | Pengembalian</title>
    <script>
        function showAlert(status) {
            if (status == 'success') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Peminjaman Berhasil!',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
    </script>
</head>

<body>
    <?php
    if (isset($_SESSION['pinjaman']) == 'pinjam') {
    ?>
        <script>
            showAlert('success')
        </script>
    <?php
        unset($_SESSION['pinjaman']);
    } ?>
    <div class="wrapper">

        <?php include "../template/sidebar.php" ?>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <?php include "../template/navbardashboard.php"; ?>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="row">
                        <?php include "../template/user_data.php"; ?>


                        <div class="row">
                            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                                <div class="card flex-fill">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Items Dipinjam
                                            <a href="./in_pending.php" class="btn btn-success position-relative"><i class="align-middle" data-feather="repeat"></i>
                                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="pending"><?php
                                                                                                                                                            $pending = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail LEFT JOIN tb_peminjaman ON tb_peminjaman.id_peminjaman = tb_peminjaman_detail.id_peminjaman WHERE tb_peminjaman_detail.id_status_p = 1 AND tb_peminjaman.id_user = $user_id");
                                                                                                                                                            $row = mysqli_num_rows($pending);
                                                                                                                                                            echo (int)$row;
                                                                                                                                                            ?></span>
                                                <span class="visually-hidden">pending</span>
                                            </a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container-fluid p-0">
                            <div class="row">

                                <?php foreach ($detail_peminjaman as $key2) : ?>


                                    <div class="col-12 col-md-3">
                                        <div class="card">
                                            <img class="card-img-top" src="../inventaris-page/foto_item/<?= $key2['foto']; ?>" alt="Unsplash" style="width: 315px;">
                                            <div class="card-header" style="margin-bottom: -40px;">
                                                <h5 class="card-title"><?= $key2['nama_barang']; ?></h5>
                                                <a href="" style="color: #6f6d6f; font-family: sans-serif;"></a>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-center">
                                                    <form action="update_status.php" method="post" class="d-inline">
                                                        <input type="hidden" name="id_detail" value="<?= $key2['id_detail'] ?>">
                                                        <input type="hidden" name="id_barang" value="<?= $key2['id_barang'] ?>">
                                                        <input type="hidden" name="jumlah_awal" value="<?= $key2['jmlhD'] ?>">
                                                        <input type="hidden" name="id_peminjaman" value="<?= $key2['id_peminjaman'] ?>">
                                                        <div class="col-md-4 input-group">
                                                            <input type="number" class="form-control" max="<?= $key2['jmlhD'] ?>" min="1" value="<?= $key2['jmlhD'] ?>" name="input_j">
                                                            <button class="btn btn-outline-secondary" type="submit" id="update">
                                                                <i class="align-middle" data-feather="upload-cloud"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <p class="card-title text-center text-warning" style="font-size: 10px;"><b>Borrowed On </b><span class="text-dark"><?= $key2['tanggal_peminjaman'] ?></span></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                        </div>




                    </div>
            </main>
            <?php include "../template/footer.php" ?>
        </div>
    </div>


    <script src="./js/app.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>

</html>