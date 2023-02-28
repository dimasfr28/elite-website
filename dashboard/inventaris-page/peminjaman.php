<?php
include "../../function.php";
session_start();

if (!isset($_SESSION['login'])) {
    header('location:../login/');
    exit;
}

//grafik
$grafik = mysqli_query($conn, "SELECT date FROM tb_kas_keluar GROUP BY date ORDER BY id_kas_keluar ASC LIMIT 7");
$grafiksaldo = mysqli_query($conn, "SELECT SUM(saldo) FROM tb_kas_keluar GROUP BY date ORDER BY id_kas_keluar ASC LIMIT 7");

date_default_timezone_set('Asia/Jakarta');
$tanggal = date("j F Y");

$user = mysqli_query($conn, "SELECT * FROM tb_user");
$hitunguser = mysqli_num_rows($user);

$peminjaman = mysqli_query($conn, "SELECT * FROM tb_peminjaman");
$hitungpeminjaman = mysqli_num_rows($peminjaman);

// $belumdikembalikan = mysqli_query($conn)

$barang = mysqli_query($conn, "SELECT tb_inventory.id_barang, tb_inventory.jumlah, tb_inventory.nama_barang, tb_inventory.foto, tb_kategori_barang.id_kategori  FROM tb_inventory LEFT JOIN tb_kategori_barang ON tb_inventory.id_kategori =  tb_kategori_barang.id_kategori");
$hitungbarang = mysqli_num_rows($barang);

$i= 1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../template/head.php" ?>
    <title>Dashboard | Peminjaman</title>
</head>

<body>
    <div class="wrapper">

        <?php include "../template/sidebar.php" ?>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <?php include "../template/navbardashboard.php"; ?>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"><strong>Inventaris</strong> Dashboard</h1>



                    <div class="row mb-4">
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Peminjaman</h5>
                                    <div class="input-group col-md-3 mt-2">
                                        <form method="post" class="input-group" style="width: 30%;">
                                            <input type="text" class="form-control" name="month" id="month" onchange="this.form.submit()">
                                            <span class="input-group-text"><i class="align-middle" data-feather="search"></i></span>
                                        </form>
                                    </div>
                                    <?php
                                            if (@$_POST['month'] == null) {
                                                $select = mysqli_query($conn, "SELECT * FROM tb_peminjaman LEFT JOIN tb_user ON tb_peminjaman.id_user = tb_user.id_user ORDER BY id_peminjaman ASC");
                                            } elseif ($_POST['month'] != null) {
                                                $post = $_POST['month'];
                                                $select = mysqli_query($conn, "SELECT * FROM tb_peminjaman LEFT JOIN tb_user ON tb_peminjaman.id_user = tb_user.id_user WHERE tb_user.nama_lengkap LIKE '%$post%'");
                                                $date = strtotime($post);
                                                $date = date("F Y", $date);
                                            }
                                            ?>
                                </div>
                                <div class="container">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Peminjam</th>
                                                    <th scope="col">Tanggal Dipinjam</th>
                                                    <th scope="col">Barang</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tanggal Dikembalikan</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                            <?php 
                                            foreach ($select as $key) {
                                                $id = $key["id_peminjaman"];
                                            ?>
                                            <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td scope="col"><?= $key["nama_lengkap"] ?></td>
                                                    <td scope="col"><?= $key["tanggal_peminjaman"] ?></td>
                                                    <td scope="col">
                                                        <?php 
                                                            $detail = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail LEFT JOIN tb_inventory ON tb_peminjaman_detail.id_barang = tb_inventory.id_barang WHERE tb_peminjaman_detail.id_peminjaman = $id");
                                                            foreach ($detail as $value) {
                                                        ?>
                                                        <ul>
                                                            <li class="align-middle"><?= $value["nama_barang"] ?></li>
                                                        </ul>
                                                        <?php
                                                            }
                                                        ?>
                                                    </td>
                                                    <td scope="col">
                                                        <?php 
                                                            $jumlah = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail WHERE id_peminjaman = $id");
                                                            foreach ($jumlah as $jml) {
                                                        ?>
                                                        <ul>
                                                            <li class="align-middle"><?= $jml["jumlah"] ?></li>
                                                        </ul>
                                                        <?php
                                                            }
                                                        ?>
                                                    </td>
                                                    <td scope="col">
                                                        <?php 
                                                            $status = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail LEFT JOIN tb_status_pengembalian ON tb_peminjaman_detail.id_status_p = tb_status_pengembalian.id_status_p WHERE tb_peminjaman_detail.id_peminjaman = $id");
                                                            foreach ($status as $dt) {
                                                        ?>
                                                        <ul>
                                                            <li class="align-middle"><?= $dt["nama_status"] ?></li>
                                                        </ul>
                                                        <?php
                                                            }
                                                        ?>
                                                    </td>
                                                    <td scope="col">
                                                        <?php 
                                                            $tanggal = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail WHERE      tb_peminjaman_detail.id_peminjaman = $id");
                                                            foreach ($tanggal as $value) {
                                                        ?>
                                                        <ul>
                                                            <li class="align-middle"><?= $value["tanggal_kembali"] ?></li>
                                                        </ul>
                                                        <?php
                                                            }
                                                        ?>
                                                    </td>
                                                    
                                                </tr>
                                            <?php 
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
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