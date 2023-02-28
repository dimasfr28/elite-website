<?php
include "../../koneksi/conn.php";
include "../../function.php";
include "./function/session.php";
include "./function/index.php";

$saldokas = mysqli_query($conn, "SELECT SUM(saldo) AS s_kas FROM tb_kas_siswa");
$saldopengeluaran = mysqli_query($conn, "SELECT SUM(saldo) AS s_keluar FROM tb_kas_keluar");
// $totalsaldo = $saldokas - $saldopengeluaran;
$assosk = mysqli_fetch_assoc($saldokas);
$assocp = mysqli_fetch_assoc($saldopengeluaran);
$implodekas = $assosk['s_kas'];
$implodep = $assocp['s_keluar'];
$saldototal = (int)$implodekas - (int)$implodep;
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "../template/head.php"; ?>
	<title>Dashboard | Bendahara</title>
	<script>
		function showAlert(status) {
			if (status == 'success') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Saldo Berhasil Diupdate!',
					showConfirmButton: false,
					timer: 1500
				})
			} else if (status == 'error') {
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: 'Saldo User Minus!',
					showConfirmButton: false,
					timer: 1500
				})
			}
		}
	</script>
</head>

<body>
	
	<?php 
	if (@$_SESSION['success'] == "sukses") {
	?>
		<script>
			showAlert('success')
		</script>
	<?php
		unset($_SESSION['success']);
	} else if (@$_SESSION['success'] == "minus") { ?>
		<script>
			showAlert('error')
		</script>
	<?php
		unset($_SESSION['success']);
	} ?>
	<div class="wrapper">

		<?php include "../template/sidebar.php" ?>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<?php include "../template/navbardashboard.php"; ?>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Bendahara</strong> Dashboard</h1>

					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
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
												<h1 class="mt-1 mb-3"><?= $rowkas; ?> Users</h1>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Saldo KAS</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="trending-up"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?= rupiah($implodekas); ?></h1>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total KAS</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="dollar-sign"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?= rupiah($saldototal); ?></h1>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Pengeluaran KAS</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="trending-down"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3"><?= rupiah($implodep); ?></h1>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-6 col-xxl-7">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Pengeluaran Minggu Terakhir</h5>
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
									<h5 class="card-title mb-0">Kas</h5>
									<div class="input-group col-md-3 mt-2">
										<form method="post" class="input-group" style="width: 30%;" id="my-form">
											<input type="text" class="form-control" name="user" id="user" onchange="this.form.submit()">
											<span class="input-group-text"><i class="align-middle" data-feather="search"></i></span>
										</form>
									</div>
								</div>
								<table class="table table-hover my-0">
									<thead>
										<tr>
											<th>Nama</th>
											<th class="d-none d-xl-table-cell">Kelas</th>
											<th class="d-none d-xl-table-cell">Saldo</th>
											<th>Terakhir Diperbarui</th>
											<th class="d-none d-md-table-cell">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$query = @$_POST["user"];
										if ($query != null) {
											$data_kas = mysqli_query($conn, "SELECT *, tb_kas_siswa.id_user AS id FROM tb_kas_siswa LEFT JOIN tb_user ON tb_kas_siswa.id_user =  tb_user.id_user LEFT JOIN tb_kelas ON tb_kelas.id_kelas = tb_user.id_kelas WHERE tb_user.nama_lengkap LIKE '%$query%' LIMIT $halaman_awal, $batas");
										} elseif (@$query == null) {
											$data_kas = mysqli_query($conn, "SELECT *, tb_kas_siswa.id_user AS id FROM tb_kas_siswa LEFT JOIN tb_user ON tb_kas_siswa.id_user =  tb_user.id_user LEFT JOIN tb_kelas ON tb_kelas.id_kelas = tb_user.id_kelas LIMIT $halaman_awal, $batas");
										}
										foreach ($data_kas as $datakas) {
										?>
											<tr>
												<td><?php
													if ($datakas["nama_lengkap"] == null) {
														echo $datakas["id"];
													} elseif ($datakas["nama_lengkap"] != null) {
														echo $datakas["nama_lengkap"];
													}

													?></td>
												<td class="d-none d-xl-table-cell" <?php
																					if ($datakas["nama_lengkap"] == null) {
																						echo 'style="color: red; font-weight: bold;"';
																					} elseif ($datakas["nama_lengkap"] != null) {
																					}
																					?>><?php
																						if ($datakas["nama_lengkap"] == null) {
																							echo 'User Ini Telah Keluar';
																						} elseif ($datakas["nama_lengkap"] != null) {
																							echo $datakas["nama_kelas"];
																						}
																						?></td>
												<td class="d-none d-xl-table-cell"><?= rupiah($datakas["saldo"]) ?></td>
												<td><span class="badge bg-success"><?= $datakas["updated_at"] ?></span></td>
												<?php
												$role = $datakas["id_role"];
												if ($role == 5) {
													echo '<td></td>';
												} elseif ($datakas["nama_lengkap"] == null) {
													echo '<td></td>';
												} elseif ($role != 5) {
													echo '
												<td class="d-none d-md-table-cell">
											<form action="" method="post">
												<input type="hidden" name="id_kas" value="';
													echo $datakas['id_kas'];
													echo	'">
												<input type="hidden" name="id_user" value="
												';
													echo $datakas['id_user'];
													echo '">
												<input type="hidden" value="';
													echo $tanggal;
													echo '" name="tanggal">
												<input type="hidden" value="';
													echo $datakas['saldo'];
													echo '" name="saldo">
												<input required type="number" name="saldotambah" style="width: 40px;">
												<input type="submit" name="tambah_saldo" class="btn btn-outline-success">
											</form>
											</td>
												';
												}
												?>
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
			<?php include "../template/footer.php"; ?>

		</div>
	</div>

	<script src="./js/app.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(255, 0, 0, 0.1)");
			gradient.addColorStop(1, "rgba(255, 0, 0, 0.1)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: [
						<?php
						while ($tanggalg = mysqli_fetch_array($grafik)) {
							echo '"' . $tanggalg['date'] . '",';
						}
						?>
					],
					datasets: [{
						label: "Pengeluaran",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.danger,
						data: [
							<?php
							$max = mysqli_query($conn, "SELECT max(saldo) as max FROM tb_kas_keluar");
							$maxs = mysqli_fetch_assoc($max);
							foreach ($grafiksaldo as $tes) {
								echo '"' . $tes["total"] . '",';
							}
							?>
						],
					}]
				},
				options: {
					maintainAspectRatio: false,
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
							}
						}],
						yAxes: [{
							ticks: {
								min: 0,
								padding: 10,
								maxTicksLimit: 5,
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