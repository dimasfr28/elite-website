<?php

include "../../koneksi/conn.php";
include "./function/session.php";
include "./function/class_controll.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "../template/head.php" ?>
	<title>Dashboard | Class Controll</title>
	<script>
		function showAlert(status) {
			if (status == 'success') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Class berhasil ditambahkan!',
					showConfirmButton: false,
					timer: 1500
				})
			} else if (status == 'error') {
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: 'Class Gagal ditambahkan!',
					showConfirmButton: false,
					timer: 1500
				})
			} else if (status == 'update') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Class Data Berhasil Di Update!',
					showConfirmButton: false,
					timer: 1500
				})
			}
		}
	</script> 
</head>

<body>
<?php if (@$_SESSION['data-success'] == "addkelas") {
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
	} else if (@$_SESSION['data-success'] == "updatekelas") { ?>
		<script>
			showAlert('update')
		</script>
	<?php
		unset($_SESSION['data-success']);
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
						<div class="col-12 col-lg-12 col-xxl-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Controll Kelas Siswa
										<a href="./add_class.php" class="btn btn-success">
											<i class="align-middle" data-feather="plus-circle"></i>
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
											<th class="ps-4">Nama</th>
											<th class="d-none d-md-table-cell">Total Siswa</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if ($query != null) {
											$data_pegawai = mysqli_query($conn, "SELECT * FROM tb_kelas WHERE nama_kelas LIKE '%$query%' ORDER BY nama_kelas ASC LIMIT $halaman_awal, $batas");
										} elseif ($query == null) {
											$data_pegawai = mysqli_query($conn, "SELECT * FROM tb_kelas  ORDER BY nama_kelas ASC LIMIT $halaman_awal, $batas");
										}
										foreach ($data_pegawai as $siswa) {

										?>
											<tr>
												<td class="ps-4"><?= $siswa['nama_kelas']; ?></td>
												<td class="d-none d-md-table-cell">
													<?php
													$id = $siswa['id_kelas'];
													$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_kelas =  $id");
													$qry = mysqli_num_rows($query);
													echo $qry;
													?>
												</td>
												<td>
													<a href="update_class.php?id_kelas=<?= $siswa["id_kelas"]; ?>" class="btn btn-primary"><i class="align-middle" data-feather="edit"></i></a>
													<a href="./function/delete_class.php?id_kelas=<?= $siswa["id_kelas"] ?>" class="btn btn-danger hapus-class"><i class="align-middle" data-feather="trash"></i></a>
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

	<script src="../js/app.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function() {
			$('.hapus-class').on('click', function() {
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