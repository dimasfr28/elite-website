<?php
include "../../function.php";
include "./function/session.php";
include "./function/pengeluaran.php";
include "./function/add_pengeluaran.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "../template/head.php"; ?>
	<title>Dashboard | Pengeluaran</title>
	<script>
		function showAlert(status) {
			if (status == 'success') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Pengeluaran Berhasil Ditambahkan!',
					showConfirmButton: false,
					timer: 1500
				})
			} else if (status == 'success1') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Pengeluaran Berhasil Diupdate!',
					showConfirmButton: false,
					timer: 1500
				})
			}
		}
	</script>
</head>

<body>

	<?php
	if (@$_SESSION['success'] == "berhasil") {
	?>
		<script>
			showAlert('success')
		</script>
	<?php
		unset($_SESSION['success']);
	} else if (@$_SESSION['success'] == "update") { ?>
		<script>
			showAlert('success1')
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
					<h1 class="h3 mb-3"><strong>PENGELUARAN</strong> KAS</h1>
					<div class="row">
						<div class="col-12 col-lg-12 col-xxl-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Pengeluaran
										<a href="./add_pengeluaran.php" class="btn btn-success"> <i class="align-middle" data-feather="plus-square"></i></a>
									</h5>
									<form method="post" class="input-group mt-3" style="width: 20%;">
										<input type="text" class="form-control" name="deskripsi" id="deskripsi" onchange="this.form.submit()">
										<span class="input-group-text"><i class="align-middle" data-feather="search"></i></span>
									</form>
								</div>
								<table class="table table-hover my-0">
									<thead>
										<tr>
											<th class="d-none d-xl-table-cell">Id</th>
											<th>Description</th>

											<th class="d-none d-xl-table-cell">Tanggal</th>
											<th class="d-none d-xl-table-cell">Saldo</th>
											<th>Nota</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$query = @$_POST["deskripsi"];
										if ($query != null) {
											$data_kas = mysqli_query($conn, "SELECT * FROM tb_kas_keluar WHERE deskripsi LIKE '%$query%' LIMIT $halaman_awal, $batas");
										} elseif (@$query == null) {
											$data_kas = mysqli_query($conn, "SELECT * FROM tb_kas_keluar LIMIT $halaman_awal, $batas");
										}
										foreach ($data_kas as $datap) {
										?>
											<tr>
												<td><?= $loopid++ ?></td>
												<td class="d-none d-xl-table-cell"><?= $datap["deskripsi"] ?></td>
												<td class="d-none d-md-table-cell"><?= $datap["date"] ?></td>
												<td class="d-none d-xl-table-cell"><?= rupiah($datap["saldo"]) ?></td>
												<td><img src="./nota/<?= $datap["nota"] ?>" alt="" width="50px"></td>
												<td>
													<a href="./update_pengeluaran.php?id_kas_keluar=<?= $datap["id_kas_keluar"]; ?>" class="btn btn-primary"><i class="align-middle" data-feather="edit"></i></a>
													<a id="delete" href="./function/delete.php?id_kas_keluar=<?= $datap["id_kas_keluar"]; ?>" class="btn btn-danger delp"><i class="align-middle" data-feather="trash"></i></a>
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
			<?php include "../template/footer.php"; ?>
		</div>
	</div>

	<script src="./js/app.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function() {
			$('.delp').on('click', function() {
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

</body>

</html>