<?php

include "../../koneksi/conn.php";
include "./function/session.php";
include "./function/index.php";

// echo $_SESSION['data-success'];
// exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "../template/head.php" ?>
	<title>Dashboard | Admin</title>


	<script>
		function showAlert(status) {
			if (status == 'success') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'User berhasil ditambahkan!',
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
	} ?>
	<div class="wrapper">
		<?php
		$lama = 1;
		$qry = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_role = 7 AND DATEDIFF(CURDATE(), tanggal_daftar) > 1");
		while ($siswa = mysqli_fetch_assoc($qry)) {
			$ids = $siswa['id_user'];
			$delete = mysqli_query($conn, "DELETE FROM tb_user WHERE id_user = $ids");
			return $delete;
		}
		?>

		<?php include "../template/sidebar.php" ?>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<?php include "../template/navbardashboard.php"; ?>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Admin</strong> Dashboard</h1>

					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Users</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?= $totaluser ?> Users</h1>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Inventory</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="inbox"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?= $total_barang; ?> Items</h1>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Kas</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="dollar-sign"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?= rupiah($total_saldo); ?></h1>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Peminjaman</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="archive"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?= $total_peminjaman; ?> Peminjam</h1>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-6 col-xxl-7">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Pemasukan Kas</h5>
								</div>
								<div class="card-body py-3">
									<div class="chart chart-sm">
										<canvas id="chartjs-dashboard-line"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-lg-12 col-xxl-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Users Data
										<a href="./add_user.php" class="btn btn-success">
											<i class="align-middle" data-feather="user-plus"></i>
										</a>
									</h5>
								</div>
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
											<th class="d-none d-xl-table-cell">Profil</th>
											<th>Nama</th>
											<th class="d-none d-xl-table-cell">Kelas</th>
											<th class="d-none d-md-table-cell">Role</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if ($query != null) {
											$data_pegawai = mysqli_query($conn, "SELECT * FROM tb_user LEFT JOIN tb_kelas ON tb_user.id_kelas = tb_kelas.id_kelas LEFT JOIN tb_role ON tb_user.id_role = tb_role.id_role WHERE tb_user.nama_lengkap LIKE '%$query%' AND NOT tb_user.id_user = $id AND NOT tb_user.id_role = 6  AND NOT tb_user.id_role = 7 LIMIT $halaman_awal, $batas");
										} elseif ($query == null) {
											$data_pegawai = mysqli_query($conn, "SELECT * FROM tb_user LEFT JOIN tb_kelas ON tb_user.id_kelas = tb_kelas.id_kelas LEFT JOIN tb_role ON tb_user.id_role = tb_role.id_role WHERE NOT tb_user.id_user = $id AND NOT tb_user.id_role = 6  AND NOT tb_user.id_role = 7 LIMIT $halaman_awal, $batas");
										}

										foreach ($data_pegawai as $siswa) {
										?>
											<tr>
												<td class="d-none d-xl-table-cell"><img src="../../profile/<?= $siswa['image_profile']; ?>" height="40px"></td>
												<td><?= $siswa['nama_lengkap']; ?></td>
												<td class="d-none d-xl-table-cell"><?= $siswa['nama_kelas']; ?></td>
												<td class="d-none d-md-table-cell"><?= $siswa['nama_role']; ?></td>
												<td>
													<a href="./update.php?id_user= <?= $siswa["id_user"]; ?>" class="btn btn-primary"><i class="align-middle" data-feather="edit"></i></a>
													<a id="delete" href="./delete.php?id_user=<?= $siswa["id_user"] ?>" class="btn btn-danger sweet-delete"><i class="align-middle" data-feather="trash"></i></a>
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
			$('.sweet-delete').on('click', function() {
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
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: [
						<?php
						foreach ($grafik as $tanggal) {
							echo '"' . $tanggal['updated_at'] . '",';
						}
						?>
					],
					datasets: [{
						label: "Saldo",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: [
							<?php
							$max = mysqli_query($conn, "SELECT MAX(saldo) as max FROM tb_kas_siswa");
							$maxs = mysqli_fetch_assoc($max);
							foreach ($grafik as $grafik_kas) {
								echo '"' . $grafik_kas['saldo'] . '",';
							}
							?>
						]
					}]
				},
				options: {
					maintainAspectRatio: false,
					layout: {
						padding: {
							left: 10,
							right: 25,
							top: 25,
							bottom: 0
						},
					},
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							},
							ticks: {
								maxTicksLimit: 6
							},
							maxBarThickness: 25,
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000,
								min: 0,
								max: <?= $maxs['max'] ?>,
								padding: 10,
								maxTicksLimit: 5,
							},
							layout: {
								padding: {
									top: 20,
								},
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});
	</script>



</body>

</html>