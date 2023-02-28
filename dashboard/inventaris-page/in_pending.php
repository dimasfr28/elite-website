<?php
include "../../koneksi/conn.php";
include "../../function.php";
include "./function/session.php";
include "./function/in_pending.php";

$pending = mysqli_query($conn, "SELECT *, tb_peminjaman_detail.jumlah AS jumlahP FROM tb_peminjaman_detail RIGHT JOIN tb_peminjaman ON tb_peminjaman.id_peminjaman = tb_peminjaman_detail.id_peminjaman LEFT JOIN tb_inventory ON tb_inventory.id_barang = tb_peminjaman_detail.id_barang LEFT JOIN tb_user ON tb_peminjaman.id_user = tb_user.id_user WHERE tb_peminjaman_detail.id_status_p = 1");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../template/head.php"; ?>
    <title>Dashboard | Panding Items</title>
    <script>
        function showAlert(status) {
            if (status == 'success') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Barang Berhasil Dikonfirmasi',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
    </script>
</head>

<body>
<?php if (@$_SESSION['confirm'] == "sukses") {
    ?>
        <script>
            showAlert('success')
        </script>
    <?php
        unset($_SESSION['confirm']);
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
                                    <h5 class="card-title mb-0">Konfirmasi Pengembalian</h5>
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
                                                <form method="post">
                                                    <input type="hidden" name="id_detail" value="<?= $key2['id_detail'] ?>">
                                                    <input type="hidden" name="id_peminjaman" value="<?= $key2['id_peminjaman'] ?>">
                                                    <button type="submit" class="btn btn-success btn-sm"><?= $key2['jumlahP'] ?> Items <i class="align-middle" data-feather="share"></i></button>
                                                </form>
                                            </div>
                                            <p class="card-title text-center text-warning" style="font-size: 10px;"><b>Borrowed On </b><span class="text-dark"><?= $key2['tanggal_peminjaman'] ?></span></p>
                                            <p class="card-title text-center text-primary mt-n2" style="font-size: 10px;"><b>Borrower </b><span class="text-dark"><?= $key2['nama_lengkap'] ?></span></p>
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


    <script src="js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>