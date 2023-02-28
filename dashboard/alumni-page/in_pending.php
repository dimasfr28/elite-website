<?php
include "../../function.php";
include "./function/session.php";

$user_id = $_SESSION['login']['id_user'];

$pending = mysqli_query($conn, "SELECT *, tb_peminjaman_detail.jumlah AS jumlahP FROM tb_peminjaman_detail RIGHT JOIN tb_peminjaman ON tb_peminjaman.id_peminjaman = tb_peminjaman_detail.id_peminjaman LEFT JOIN tb_inventory ON tb_inventory.id_barang = tb_peminjaman_detail.id_barang WHERE tb_peminjaman.id_user = $user_id AND tb_peminjaman_detail.id_status_p = 1");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../template/head.php"; ?>
    <title>Dashboard | Pending</title>
    <script>
        function showAlert(status) {
            if (status == 'success') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Pengembalian Berhasil Tunggu Konfirmasi Inventaris!',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
    </script>
</head>

<body>
    <?php
    if (isset($_SESSION['pinjaman']) == 'kembali') {
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
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Items Sedang Pending</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid p-0">
                        <div class="row">

                            <?php foreach ($pending as $key2) : ?>


                                <div class="col-12 col-md-3">
                                    <div class="card">
                                        <img class="card-img-top" src="../inventaris-page/foto_item/<?= $key2['foto']; ?>" alt="Unsplash" style="width: 315px;">
                                        <div class="card-header" style="margin-bottom: -40px;">
                                            <h5 class="card-title" style="font-size: 14px;"><?= $key2['nama_barang']; ?></h5>
                                            <a href="" style="color: #6f6d6f; font-family: sans-serif;"></a>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-secondary btn-sm disabled"><?= $key2['jumlahP'] ?> Items</button>
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
        </div>
    </div>


    <script src="js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>




</body>

</html>