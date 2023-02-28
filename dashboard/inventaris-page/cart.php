<?php

include "../../koneksi/conn.php";
include "../../function.php";
include "./function/cart.php";
include "./function/session.php";

$user_id = $_SESSION['login']['id_user'];

$cart = mysqli_query($conn, "SELECT *, tb_cart.jumlah AS jumlah_cart, tb_inventory.jumlah as jmlInv FROM tb_cart LEFT JOIN tb_inventory ON tb_cart.id_barang = tb_inventory.id_barang WHERE tb_cart.id_user = $user_id");

if (isset($_POST['addpeminjaman'])) {
    if (addpeminjaman($_POST) > 0) {
        // header('location:cart.php');
    } else {
        echo mysqli_error($conn);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../template/head.php"; ?>
    <title>Dashboard | Cart</title>
    <script>
        function showAlert(status) {
            if (status == 'error') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Jumlah Tidak Boleh Kosong!',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else if (status == 'error2') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Barang Melebihi Stok!',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
    </script>
</head>

<body>
    <?php if (@$_SESSION['error'] == "kurang") {
    ?>
        <script>
            showAlert('error')
        </script>
    <?php
        unset($_SESSION['error']);
    } elseif (@$_SESSION['error'] == "lebih") {
    ?>
        <script>
            showAlert('error2')
        </script>
    <?php
        unset($_SESSION['error']);
    } ?>
    <div class="wrapper">

        <?php include "../template/sidebar.php" ?>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <?php include "../template/navbardashboard.php"; ?>
            </nav>

            <main class="content">
                <div class="row mb-4">
                    <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Cart</h5>
                            </div>
                            <table class="table table-hover mt-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($cart as $key) {
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $key["nama_barang"] ?></td>
                                            <?php
                                            $id_b = $key['id_barang'];
                                            $query = mysqli_query($conn, "SELECT SUM(jumlah) as dipinjam FROM tb_peminjaman_detail WHERE id_barang = $id_b AND NOT id_status_p = 2 GROUP BY id_barang");
                                            $inventory = mysqli_query($conn, "SELECT * FROM tb_inventory WHERE id_barang = $id_b");
                                            $inv = mysqli_fetch_assoc($inventory);
                                            $dipinjam = mysqli_fetch_assoc($query);
                                            if (@$dipinjam == null) {
                                                $max = $inv['jumlah'];
                                            } elseif ($dipinjam != null) {
                                                $max = $inv['jumlah'] - (int)$dipinjam['dipinjam'];
                                            }
                                            $in_d = @(int)$dipinjam['dipinjam'];
                                            if(@$in_d == $inv['jumlah']) {
                                                $del = mysqli_query($conn, "DELETE FROM tb_cart WHERE id_barang = $id_b");
                                            }

                                            ?>
                                            <td class="d-flex flex-row">
                                                <form action="./update_cart.php" method="POST" id="submit_form">
                                                    <input type="hidden" name="id_barang" value="<?= $key["id_barang"] ?>">
                                                    <input type="hidden" name="id_user" value="<?= $user_id; ?>">
                                                    <input type="hidden" name="jumlah_awal" value="<?= $key["jumlah_cart"] ?>">

                                                    <button type="submit" class="btn btn-danger">-</button>
                                                </form>
                                                <p class="btn text-dark text-center mx-2" style="border-color: black;"><?= $key["jumlah_cart"] ?></p>
                                                <form action="update_plus_c.php" method="POST">
                                                    <input type="hidden" name="id_barang" value="<?= $key["id_barang"] ?>">
                                                    <input type="hidden" name="id_user" value="<?= $user_id; ?>">
                                                    <input type="hidden" name="jumlah_awal" value="<?= $key["jumlah_cart"] ?>">
                                                    <button class="btn btn-warning mx-2">+</button>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="delete_cart.php?id_cart=<?= $key["id_cart"]; ?>" class="btn btn-danger"><i class="align-middle" data-feather="x"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }

                                    ?>
                                </tbody>
                            </table>
                            <hr>
                            <div class="container justify-content-center d-flex mb-4">
                                <form action="pembelian.php" method="POST">
                                    <input type="hidden" name="id_user" value="<?= $user_id; ?>">
                                    <button class="btn btn-primary" type="submit" name="addpeminjaman" style="width: 500px;">Pinjam</button>
                                </form>
                            </div>
                        </div>
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