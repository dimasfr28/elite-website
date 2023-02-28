<?php

include "../../koneksi/conn.php";
include "../../function.php";
include "./function/session.php";
include "./function/report_kas.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../template/head.php" ?>
    <title>Dashboard | Report Kas</title>
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

                    <div class="mb-3">
                        <h1 class="h3 d-inline align-middle">Report Kas</h1>
                        <a href="
                        <?php
                        if (@$_POST["mounth"] == null) {
                            echo './function/cetak_all_bendahara.php';
                        } elseif ($_POST["mounth"] == 'all') {
                            echo './function/cetak_all_bendahara.php';
                        } elseif ($_POST["mounth"] == 'mounth') {
                            echo './function/cetak_bulanan_bendahara.php';
                        }
                        ?>
                        " class="badge bg-dark text-white ms-2 disabled" href="add-post.php">
                            <i class="align-middle" data-feather="file-plus"></i>
                        </a>
                        <div class="col-md-3 mt-1 mb-4">
                            <form method="post">
                                <select class="form-select" name="mounth" id="mounth" onchange="this.form.submit()">
                                    <option selected value="all">Laporan Akhir Kas</option>
                                    <option value="mounth" <?php
                                                            if (@$_POST['mounth'] == 'mounth') {
                                                                echo "selected";
                                                            }
                                                            ?>>Laporan Bulan Ini</option>
                                </select>
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
                                        <p class="fs-5 fw-bold ">Laporan Kas ELITE</p>
                                        <p class="fs-5 fw-bold mt-n3 ">
                                            <?php
                                            if (@$_POST['mounth'] == null) {
                                            } elseif ($_POST['mounth'] == 'all') {
                                                echo '';
                                            } elseif ($_POST['mounth'] == 'mounth') {
                                                $date = date('F Y');
                                                echo $date;
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <!-- <div class="container">
                                <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Pendapatan</th>
                                    <th scope="col">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <tr>
                                    <td>Total Kas Siswa</td>
                                    <td>
                                        <?php
                                        echo rupiah($implode);
                                        ?>
                                    </td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr>
                                    <th scope="col">Pengeluaran</th>
                                    <th scope="col">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <?php
                                    foreach ($pengeluaran as $key) {
                                    ?>
                                    <tr>
                                    <td><?= $key["deskripsi"]; ?></td>
                                    <td><?= $key["saldo"]; ?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <thead>
                                    <tr>
                                    <th scope="col">Total :</th>
                                    <th scope="col"><?= rupiah($total_kas) ?></th>
                                    </tr>
                                </thead>
                                </table>
                            </div> -->
                                    <div class="container">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Pendapatan</th>
                                                    <th scope="col">Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                                <tr>
                                                    <td>Total Kas Siswa</td>
                                                    <td>
                                                        <?php
                                                        echo rupiah($implode);
                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <thead>
                                                <tr>
                                                    <th scope="col">Pengeluaran</th>
                                                    <th scope="col">Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                                <?php
                                                if (@$_POST['mounth'] == null) {
                                                    $query_keluar = mysqli_query($conn, "SELECT *, SUM(saldo) AS t_saldo FROM tb_kas_keluar");
                                                    foreach ($query_keluar as $key) {
                                                ?>
                                                        <tr>
                                                            <td>Total Pengeluaran</td>
                                                            <td><?= $key['t_saldo']; ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } elseif (@$_POST['mounth'] == 'all') {
                                                    $query_keluar = mysqli_query($conn, "SELECT *, SUM(saldo) AS t_saldo FROM tb_kas_keluar");
                                                    foreach ($query_keluar as $key) {
                                                    ?>
                                                        <tr>
                                                            <td>Total Pengeluaran</td>
                                                            <td><?= $key['t_saldo']; ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } elseif ($_POST['mounth'] == 'mounth') {
                                                    $date = date('F Y');
                                                    $notmounth = mysqli_query($conn, "SELECT SUM(saldo) AS saldo_p FROM tb_kas_keluar WHERE NOT date LIKE '%$date%'");
                                                    $inmounth = mysqli_query($conn, "SELECT * FROM tb_kas_keluar WHERE date LIKE '%$date%'");
                                                    foreach ($notmounth as $key) {
                                                    ?>
                                                        <tr>
                                                            <td>Pengeluaran Sebelumnya</td>
                                                            <td><?= $key["saldo_p"]; ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"> Pengeluaran Bulan Ini :</th>
                                                            <th scope="col"></th>
                                                        </tr>
                                                    </thead>
                                            <tbody class="table-group-divider">
                                                <?php
                                                    foreach ($inmounth as $key) {
                                                ?>
                                                    <tr>
                                                        <td><?= $key["deskripsi"]; ?></td>
                                                        <td><?= rupiah($key["saldo"]); ?></td>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        <?php
                                                }
                                        ?>
                                        </tbody>
                                        <thead>
                                            <tr>
                                                <th scope="col">Total :</th>
                                                <th scope="col"><?= rupiah($total_kas) ?></th>
                                            </tr>
                                        </thead>
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