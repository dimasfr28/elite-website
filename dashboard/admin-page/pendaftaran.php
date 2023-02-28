<?php

include "../../koneksi/conn.php";
include "./function/session.php";
include "./function/class_controll.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "../template/head.php" ?>
	<title>Dashboard | Pendaftaran</title>
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

					<div class="row">
						<div class="col-12 col-lg-12 col-xxl-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Pendaftaran</h5>
									<?php
										$lama = 1;
										$qry = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_role = 7 AND DATEDIFF(CURDATE(), tanggal_daftar) > 1");
										while ($siswa = mysqli_fetch_assoc($qry)) {
											$ids = $siswa['id_user'];
											$delete = mysqli_query($conn, "DELETE FROM tb_user WHERE id_user = $ids");
											return $delete;
										}
										?>
								<div class="d-inline-flex" style="width: 30%;">
									<form class="input-group p-3" method="POST">
										<input type="text" class="form-control" id="keyword" name="keyword" placeholder="Search...">
										<button type="submit" name="cari" class="btn btn-secondary"><i class="align-middle" data-feather="search"></i></button>
									</form>
									<?php
									$query = @$_POST['keyword'];
									?>
								</div>
								<table class="table table-hover my-0">
									<thead>
										<tr>
											<th>Nama</th>
											<th class="d-none d-md-table-cell">Kelas</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if ($query != null) {
											$data_pegawai = mysqli_query($conn, "SELECT * FROM tb_user LEFT JOIN tb_kelas ON tb_user.id_kelas = tb_kelas.id_kelas WHERE tb_user.nama_lengkap LIKE '%$query%' AND tb_user.id_role = 6 LIMIT $halaman_awal, $batas");
										} elseif ($query == null) {
											$data_pegawai = mysqli_query($conn, "SELECT * FROM tb_user LEFT JOIN tb_kelas ON tb_user.id_kelas = tb_kelas.id_kelas WHERE tb_user.id_role = 6 LIMIT $halaman_awal, $batas");
										}
										$i = 1;
										foreach ($data_pegawai as $siswa) {

										?>
											<tr>
												<td><?= $siswa['nama_lengkap']; ?></td>
												<td><?= $siswa['nama_kelas']; ?></td>
												<td>
													<a href="./function/terima.php?id_user=<?= $siswa["id_user"]; ?>" class="btn btn-primary terimau"><i class="align-middle" data-feather="thumbs-up"></i></a>
													<a href="./function/tolak.php?id_user=<?= $siswa["id_user"] ?>" class="btn btn-danger tolaku"><i class="align-middle" data-feather="thumbs-down"></i></a>
												</td>
											</tr>
										<?php
										}
										?>
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
			<?php include "../template/footer.php"; ?>
		</div>
	</div>
	<script src="./js/app.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script>
		$(document).ready(function() {
			$('.terimau').on('click', function() {
				var getLink = $(this).attr('href');

				Swal.fire({
					title: 'Konfirmasi User',
					text: "Anda yakin Untuk Menerima User?",
					icon: 'info',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Terima'
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = getLink;
						Swal.fire({
							position: 'center',
							icon: 'success',
							title: 'User Berhasil Diterima!',
							showConfirmButton: false,
							timer: 1500
						})
					}
				})
				return false;
			})
		});
	</script>
	<script>
		$(document).ready(function() {
			$('.tolaku').on('click', function() {
				var getLink = $(this).attr('href');

				Swal.fire({
					title: 'Konfirmasi User',
					text: "Anda yakin Untuk Menolak User?",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Tolak'
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = getLink;
						Swal.fire({
							position: 'center',
							icon: 'success',
							title: 'User Berhasil Ditolak!',
							showConfirmButton: false,
							timer: 1500
						})
					}
				})
				return false;
			})
		});
	</script>

</body>

</html>