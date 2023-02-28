<?php
include "../../koneksi/conn.php";
include "../../function.php";
include "./function/session.php";
include "./function/index.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../template/head.php" ?>
    <title>Dashboard | Inventaris</title>
    <script>
        function showAlert(status) {
            if (status == 'success') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Barang berhasil ditambahkan!',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else if (status == 'error') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Barang Gagal ditambahkan!',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else if (status == 'update') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Update Data Barang Berhasil!',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else if (status == 'dipinjam') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Barang Belum Dikembalikan!',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
    </script>
</head>

<body>

    <?php if (@$_SESSION['data-success'] == "addbarang") {
    ?>
        <script>
            showAlert('success')
        </script>
    <?php
        unset($_SESSION['data-success']);
    } else if (@$_SESSION['data-success'] == "error") { ?>
        <script>
            showAlert('error')
        </script>
    <?php
        unset($_SESSION['data-success']);
    } else if (@$_SESSION['data-success'] == "update") { ?>
        <script>
            showAlert('update')
        </script>
    <?php
        unset($_SESSION['data-success']);
    } else if (@$_SESSION['error'] == "lagidipinjam") { ?>
        <script>
            showAlert('dipinjam')
        </script>
    <?php
        unset($_SESSION['error']);
    }?>

    <div class="wrapper">

        <?php include "../template/sidebar.php" ?>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <?php include "../template/navbardashboard.php"; ?>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"><strong>Inventaris</strong> Dashboard</h1>

                    <div class="row">
                        <div class="col-xl-6 col-xxl-6 d-flex">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Users</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="users"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3"><?= $hitunguser; ?> Users</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Total Peminjaman</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="archive"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3"><?= $hitungpeminjaman; ?> Peminjam</h1>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-xxl-6 d-flex">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Jumlah Barang </h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="inbox"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3"><?= $hitungbarang; ?> Items</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Belum Dikembalikan</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="alert-octagon"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3"><?= $restored; ?> Items</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="row mb-4">
                            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                                <div class="card flex-fill">
                                    <div class="card-header">

                                        <h5 class="card-title mb-0">Inventory
                                            <a href="tambah_barang.php" class="btn btn-success">
                                                <i class="align-middle" data-feather="upload"></i>
                                            </a>
                                        </h5>
                                        <div class="input-group col-md-3 mt-2">
                                            <form method="post" class="input-group" style="width: 30%;">
                                                <input type="text" class="form-control" name="barang" id="barang" onchange="this.form.submit()">
                                                <span class="input-group-text"><i class="align-middle" data-feather="search"></i></span>
                                            </form>
                                        </div>
                                    </div>
                                    <table class="table table-hover my-0">
                                        <thead>
                                            <tr>
                                                <th class="ms-4">foto</th>
                                                <th>Nama</th>
                                                <th>Jumlah</th>
                                                <th class="d-none d-xl-table-cell">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = @$_POST["barang"];
                                            if ($query != null) {
                                                $data_pegawai = mysqli_query($conn, "SELECT * FROM tb_inventory LEFT JOIN tb_kategori_barang ON tb_inventory.id_kategori =  tb_kategori_barang.id_kategori WHERE tb_inventory.nama_barang LIKE '%$query%' LIMIT $halaman_awal, $batas");
                                            } elseif ($query == null) {
                                                $data_pegawai = mysqli_query($conn, "SELECT * FROM tb_inventory LEFT JOIN tb_kategori_barang ON tb_inventory.id_kategori =  tb_kategori_barang.id_kategori LIMIT $halaman_awal, $batas");
                                            }
                                            $i = 1;
                                            foreach ($data_pegawai as $inventory) {
                                            ?>

                                                <tr>
                                                    <td class="ms-4"> <img src="./foto_item/<?= $inventory['foto'] ?>" width="80px"> </td>
                                                    <td class="d-none d-xl-table-cell"><?= $inventory["nama_barang"] ?></td>
                                                    <td class="d-none d-xl-table-cell"><?= $inventory["jumlah"] ?></td>
                                                    <td class="align-middle">
                                                        <a href="update_barang.php?id_barang= <?= $inventory["id_barang"]; ?>" class="btn btn-warning"><i class="align-middle" data-feather="edit"></i></a>
                                                        <?php 
                                                        $idv = $inventory["id_barang"];
                                                        $sql = mysqli_query($conn, "SELECT * FROM tb_peminjaman_detail WHERE id_barang = $idv");
                                                        $as = mysqli_fetch_assoc($sql);
                                                        if ($sql->num_rows > 0) {
                                                            $idp = $as['id_barang'];
                                                            if ($as['id_status_p'] != 2) {
                                                                
                                                                $hp =  'not-hapus';
                                                                
                                                                // return false;
                                                            }elseif($as['id_status_p'] == 2) {
                                                               $hp = 'hapusi';
                                                            }
                                                        }else {
                                                            $hp = 'hapusi';
                                                        }
                                                         ?>
                                                         
                                                        <a href="delete.php?id_barang= <?= $inventory["id_barang"]; ?>" class="btn btn-danger <?= $hp  ?>"><i class="align-middle" data-feather="trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php  } ?>
                                        </tbody>
                                    </table>
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

                    </div>
            </main>
            <?php include "../template/footer.php" ?>
        </div>
    </div>

    <script src="js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.hapusi').on('click', function() {
                var getLink = $(this).attr('href');

                Swal.fire({
                    title: 'Hapus Data',
                    text: "Anda yakin ingin menghapusnya?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = getLink;
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Data Berhasil Dihapus!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })
                return false;
            })

            $('.not-hapus').on('click', function() {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Barang Belum Dikembalikan!',
                    showConfirmButton: false,
                    timer: 1500
                })
                return false;
            })
        });
    </script>
</body>

</html>