<?php
include "../../function.php";
include "./function/add_pengeluaran.php";
include "./function/session.php";


if (isset($_POST['pengeluaran'])) {

	if (pengeluaran($_POST) > 0) {
	} else {
		echo mysqli_error($conn);
	}
}
date_default_timezone_set('Asia/Jakarta');
$tanggal = date("j F Y");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "../template/head.php"; ?>
	<title>Dashboard | Add Pengeluaran</title>
	<script>
		function showAlert(status) {
			if (status == 'error') {
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: 'Ekstensi File Tidak Didukung!',
					showConfirmButton: false,
					timer: 1500
				})
			} else if (status == 'error2') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Ukuran File Terlalu Besar',
					showConfirmButton: false,
					timer: 1500
				})
			} else if (status == 'error3') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Pengeluaran Melebihi Batas',
					showConfirmButton: false,
					timer: 1500
				})
			}
		}
	</script>
</head>

<body>
	<?php if (@$_SESSION['data-success'] == "ekstensi") {
	?>
		<script>
			showAlert('error')
		</script>
	<?php
		unset($_SESSION['data-success']);
	} else if (@$_SESSION['data-success'] == "ukuran") { ?>
		<script>
			showAlert('error2')
		</script>
	<?php
		unset($_SESSION['data-success']);
	} else if (@$_SESSION['data-success'] == "pengeluaran") {
	?>
		<script>
			showAlert('error3')
		</script>
	<?php
		unset($_SESSION['data-success']);
	}
	?>

	<div class="wrapper">

		<?php include "../template/sidebar.php" ?>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<?php include "../template/navbardashboard.php"; ?>
			</nav>

			<div class="container mt-3">


				<div class="card flex-fill mt-4" style="border-radius: 20px;">
					<div class="card-header" style="border-radius: 20px;">

						<h5 class="card-title mb-0">
							<i class="align-middle" data-feather="plus-square"></i> Add New Post
						</h5>
						<hr>

						<form method="post" enctype="multipart/form-data">

				
							<input type="hidden" value="<?= $tanggal; ?>" name="tanggal">

							<div class="row g-2">
								<h5 class="card-title mb-0" class="form-label" for="saldo" style="color: #6d6d6d;">
									<label for="saldo" class="form-label" style="font-size: 20px;">*Saldo</label>
									<h5>
										<div class="form-floating">
											<input type="number" class="form-control" id="saldo" name="saldo" max="<?= (int)$saldototal; ?>">
											<label for="floatingInputValue">Enter the issued balance</label>
										</div>

										<h5 class="card-title mb-0 mt-1" class="form-label" for="nota" style="color: #6d6d6d;">
											<label for="nota" class="form-label" style="font-size: 20px;">*Nota</label>
										</h5>
										<input class="form-control form-control-lg mt-0" id="nota" name="nota" type="file">


										<div class="mb-3">
											<h5 class="card-title mb-0 mt-4" class="form-label" for="deskripsi" style="color: #6d6d6d;">
												<label for="deskripsi" class="form-label" style="font-size: 20px;">*Deskripsi</label>
											</h5>
											<textarea name="deskripsi" id="deskripsi" class="form-control" require></textarea>
										</div>
							</div>

							<div class="col-sm-5 row pb-1" style="margin-left: 29%;">
								<button type="submit" class="btn btn-primary btn-lg" name="pengeluaran" style="color: white;">Input</button>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>

	</div>
	</div>

	<script src="../js/app.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
	<!-- <script src="vendor/ckeditor/ckeditor/ckeditor.js"></script>
	<script>
		CKEDITOR.replace('deskripsi', {
			uiColor: "#dbdad9"
		});
	</script> -->
	<script type="text/javascript">
  $(document).ready(function() {
    $('#deskripsi').summernote({
      height: "300px",
      styleWithSpan: false
    });
  }); 
</script>

</body>

</html>