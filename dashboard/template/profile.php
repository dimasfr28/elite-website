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

$user_id = $_SESSION['login']['id_user'];

$user = mysqli_query($conn, "SELECT * FROM tb_kas_siswa WHERE id_user = $user_id");
$saldouser = mysqli_fetch_array($user);

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

$inventory = mysqli_query($conn, "SELECT * FROM tb_inventory");

if (isset($_POST['cart'])) {
    if (addcart($_POST) > 0) {
        header('location:./cart.php');
    } else {
        echo mysqli_error($conn);
    }
}

$user = mysqli_query($conn, "SELECT * FROM tb_user LEFT JOIN tb_role ON tb_role.id_role = tb_user.id_role LEFT JOIN tb_kelas ON tb_kelas.id_kelas = tb_user.id_kelas WHERE id_user = $user_id");
mysqli_fetch_assoc($user);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head.php" ?>
    <title>Dashboard | Profile</title>
    <script>
		function showAlert(status) {
			if (status == 'success') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'User berhasil diupdate!',
					showConfirmButton: false,
					timer: 1500
				})
			} else if (status == 'error') {
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: 'User Gagal ditambahkan!',
					showConfirmButton: false,
					timer: 1500
				})
			} else if (status == 'update') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Update Data User Berhasil!',
					showConfirmButton: false,
					timer: 1500
				})
			} 
		}
	</script>
</head>

<body>
	<?php if (@$_SESSION['data-success'] == "success") {
	?>
		<script>
			showAlert('success')
		</script>
	<?php
		unset($_SESSION['data-success']);
	} ?>
    <div class="wrapper">

        <?php include "./sidebar.php" ?>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <?php include "./navbardashboard.php"; ?>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="row d-flex justify-content-center">
                        <div class="col-6 shadow-lg p-3 mb-5 bg-body rounded">
                            <div class="card flex-fill">
                                <div class="card-header bg-dark">
                                    <h5 class="card-title mb-0"><i class="align-middle" data-feather="user"></i> Profile</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                    foreach ($user as $key) {
                                    ?>
                                        <div class="text-center">
                                            <img src="../../profile/<?= $key['image_profile'] ?>" class="rounded-circle border border-dark mb-0" style="width: 150px;
								height: 150px;
								object-fit: cover;
								object-position: center;">
                                            <h3 class="text-capitalize fw-bolder text-dark mt-2"><?= $key['nama_lengkap'] ?>
                                                <p class="fw-light fs-4">
                                                    <?php
                                                    $id_kelas = $key['id_kelas'];
                                                    $query = mysqli_query($conn, "SELECT nama_kelas FROM tb_kelas WHERE id_kelas = $id_kelas");
                                                    $select = mysqli_fetch_assoc($query);
                                                    ?>
                                                    <?= implode($select); ?>
                                                <p class="fw-semibold fs-5 mt-n3">
                                                    <?php
                                                    $id_role = $key['id_role'];
                                                    $queryrole = mysqli_query($conn, "SELECT nama_role FROM tb_role WHERE id_role = $id_role");
                                                    $role = mysqli_fetch_assoc($queryrole);
                                                    ?>
                                                    (<?= implode($role); ?>)
                                                </p>
                                            </h3>
                                        <?php
                                    }
                                        ?>
                                        <div class="d-grid gap-2 mb-1">
                                            <a href="./edit_profile.php" class="btn btn-outline-secondary mt-n2"><i class="align-middle" data-feather="edit"></i> Edit Profile</a>
                                        </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>






            </main>
            <?php include "footer.php" ?>
        </div>
    </div>


    <script src="./js/app.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>



</body>

</html>