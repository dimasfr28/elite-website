<?php
include "../../function.php";
include "./function/session.php";
include "./function/inventory.php";

$user_id = $_SESSION['login']['id_user'];
$user = mysqli_query($conn, "SELECT * FROM tb_kas_siswa WHERE id_user = $user_id");
$saldouser = mysqli_fetch_assoc($user);

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


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../template/head.php"; ?>
    <title>Dashboard | Inventory</title>
    <script>
        function showAlert(status) {
            if (status == 'error') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Barang Tidak Tersedia!',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
    </script>
</head>

<body>
    <?php
    if (@$_SESSION['error'] == "tidakt") { ?>
        <script>
            showAlert('error')
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
                <div class="container-fluid p-0">

                    <div class="row">
                        <?php include "../template/user_data.php"; ?>

                        <div class="row">
                            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                                <div class="card flex-fill">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Items Pada Inventory
                                            <a href="./cart.php" class="btn btn-success position-relative"><i class="align-middle" data-feather="shopping-cart"></i>
                                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="row_cart"><?php
                                                                                                                                                            $select = mysqli_query($conn, "SELECT * FROM tb_cart WHERE id_user = $user_id");
                                                                                                                                                            $assoc = mysqli_num_rows($select);
                                                                                                                                                            echo (int)$assoc;
                                                                                                                                                            ?>
                                                    <span class="visually-hidden">In Cart</span>
                                            </a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container-fluid p-0">
                            <div class="row">

                                <?php foreach ($inventory as $key2) : ?>


                                    <div class="col-12 col-md-3">
                                        <div class="card">
                                            <img class="card-img-top" src="../inventaris-page/foto_item/<?= $key2['foto']; ?>" alt="Unsplash" style="
								width: 200px;
								height: 200px;
								object-fit: cover;
								object-position: center;
								">
                                            <div class="card-header" style="margin-bottom: -40px;">
                                                <h5 class="card-title"><?= $key2['nama_barang']; ?></h5>
                                                <a href="" style="color: #6f6d6f; font-family: sans-serif;"></a>
                                            </div>
                                            <div class="card-body">
                                                <div class="input-group d-flex justify-content-center">
                                                    <div class="input-group-text" id="btnGroupAddon">
                                                        <?php

                                                        $id = $key2['id_barang'];
                                                        $selectid = mysqli_query($conn, "SELECT SUM(jumlah) AS p FROM tb_peminjaman_detail WHERE id_barang = $id AND NOT id_status_p = 2 GROUP BY id_barang");
                                                        $s = mysqli_fetch_assoc($selectid);
                                                        if ($s != null) {
                                                            $pengurangan = $key2["jumlah"] - $s["p"];
                                                            echo $pengurangan;
                                                        } elseif ($s == null) {
                                                            echo $key2["jumlah"];
                                                        }
                                                        ?>
                                                    </div>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id_barang" value="<?= $id ?>">
                                                        <input type="hidden" name="jumlah" value="1">
                                                        <input type="hidden" name="id_user" value="<?= $_SESSION['login']['id_user'] ?>">
                                                        <button type="submit" name="cart" class="btn btn-primary"><i class="align-middle" data-feather="shopping-cart"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <nav class="mt-3">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" <?php if ($halaman > 1) {
                                                                        echo "href='?halaman=$previous'";
                                                                    } ?>>Previous</a>
                                        </li>
                                        <?php
                                        for ($x = 1; $x <= $total_halaman; $x++) {
                                        ?>
                                            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                                        <?php
                                        }
                                        ?>
                                        <li class="page-item">
                                            <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                        echo "href='?halaman=$next'";
                                                                    } ?>>Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                        </div>




                    </div>
            </main>
            <?php include "../template/footer.php"; ?>
        </div>
    </div>
    <script src="./js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>