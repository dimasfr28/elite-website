<?php

include "../../koneksi/conn.php";
include "../../function.php";
include "./function/session.php";
include "./function/report_inventory.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../template/head.php" ?>
    <title>Dashboard | Report Inventory</title>
    <!-- <style>
        @media print{
            .container-fluid, footer, .navbar-collapse
        }
    </style> -->
</head>

<body>
    <div class="wrapper">

        <?php include "../template/sidebar.php" ?>

        <div class="main" style="background-color: #dbdad9;">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <?php include "../template/navbardashboard.php"; ?>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row mb-3 justify-content-between">
                        <div class="col-md-6 mb-3 d-flex ">
                            <h1 class="h3 align-middle">Report Inventaris</h1>
                            <?php
                            if (@$_POST['month'] == null) {
                                echo '<a href="./function/cetak_all_inventaris.php" class="btn btn-dark text-white ms-2 " href="add-post.php">
                                <i class="align-middle" data-feather="file-plus"></i>
                            </a>';
                            } elseif ($_POST['month'] != null) {
                                echo '
                                    
                                            <form action="./function/cetak_month_inventaris.php" method="post" class="mx-2">
                                                <input type="hidden" name="month" value="';
                                echo $_POST['month'];
                                echo '">
                                                    <button type="submit" class="btn btn-dark">
                                                        <i class="align-middle" data-feather="file-plus"></i>
                                                    </button>
                                            </form>
                            
                                ';
                            }
                            ?>
                        </div>
                    </div>


                    <div class="col-md-3 mt-1 mb-4 mt-n4">
                        <form method="post">
                            <input type="month" name="month" id="month" onchange="this.form.submit()" value="">
                        </form>
                    </div>

                    <div class="row pdf">
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <div class="container">
                                        <div class="row">

                                            <p class="fs-4 fw-bold text-center">SEKOLAH MENENGAH KEJURUAN NEGERI 2 SURABAYA</p>
                                            <p class="fs-5 fw-bold text-center mt-n3">ELECTRONIC INOVATION CENTER</p>
                                            <p class="fs-5 fw-bold text-center mt-n3">Jalan. Tentara Geine Pelajar 26, Petemon, Kec. Sawahan, Surabaya, Jawa Timur 60252 Tlp. 031-5343708,</p>
                                            <p class="fs-5 fw-bold text-center mt-n3">Fax. 0315475376 e-mail : smekda.surabaya@gmail.com</p>

                                            <hr>
                                        </div>
                                    </div>
                                    <p class="fs-5 fw-bold ">Laporan Peminjaman ELITE</p>
                                    <p class="fs-5 fw-bold mt-n3 ">
                                        <?php
                                        if (@$_POST['month'] == null) {
                                            $select = mysqli_query($conn, "SELECT *, tb_peminjaman.id_user AS ids FROM tb_peminjaman LEFT JOIN tb_user ON tb_peminjaman.id_user = tb_user.id_user ORDER BY id_peminjaman ASC");
                                        } elseif ($_POST['month'] != null) {
                                            $post = $_POST['month'];
                                            $select = mysqli_query($conn, "SELECT *, tb_peminjaman.id_user AS ids FROM tb_peminjaman LEFT JOIN tb_user ON tb_peminjaman.id_user = tb_user.id_user WHERE tb_peminjaman.tanggal_peminjaman LIKE '%$post%'");
                                            $date = strtotime($post);
                                            $date = date("F Y", $date);
                                            echo $date;
                                        }
                                        ?>
                                    </p>
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
                                                    <td scope="col"><?php if ($key["nama_lengkap"] == null) {
                                                                        echo $key['ids'];
                                                                    } elseif ($key["nama_lengkap"] != null) {
                                                                        echo $key["nama_lengkap"];
                                                                    } ?></td>
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
            </main>
            <?php include "../template/footer.php"; ?>
        </div>
    </div>

    <script src="./js/app.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>