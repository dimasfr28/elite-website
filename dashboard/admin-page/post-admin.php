<?php

include "../../koneksi/conn.php";
include "../../function.php";
include "./function/session.php";
include "./function/post_admin.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "../template/head.php" ?>
	<title>Dashboard | Post</title>
	<script>
		function showAlert(status) {
			if (status == 'addpost') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Post berhasil ditambahkan!',
					showConfirmButton: false,
					timer: 1500
				})
			} else if (status == 'error') {
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: 'Post Gagal ditambahkan!',
					showConfirmButton: false,
					timer: 1500
				})
			} else if (status == 'postupdate') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Update Data Post Berhasil!',
					showConfirmButton: false,
					timer: 1500
				})
			}
		}
	</script>


</head>

<body>

	<?php if (@$_SESSION['data-success'] == "addpost") {
	?>
		<script>
			showAlert('addpost')
		</script>
	<?php
		unset($_SESSION['data-success']);
	} else if (@$_SESSION['data-success'] == "error") { ?>
		<script>
			showAlert('error')
		</script>
	<?php
		unset($_SESSION['data-success']);
	} else if (@$_SESSION['data-success'] == "updatepost") { ?>
		<script>
			showAlert('postupdate')
		</script>
	<?php
		unset($_SESSION['data-success']);
	} ?>

	<div class="wrapper">

		<?php include "../template/sidebar.php" ?>

		<div class="main" style="background-color: #dbdad9;">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<?php include "../template/navbardashboard.php"; ?>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Post's</h1>
						<a class="badge bg-dark text-white ms-2" href="add-post.php">
							Add Post
						</a>
						<div class="col-md-3 mt-1 mb-4">
							<form method="post">
								<select class="form-select" name="select" id="select" onchange="this.form.submit()">
									<option selected value="all">All Post</option>
									<?php
									$c = mysqli_query($conn, "SELECT * FROM tb_kategori_post");
									while ($data = mysqli_fetch_assoc($c)) {


									?>
										<option value="<?= $data["id_kategori"] ?>" <?php
																					if (@$_POST['select'] == $data['id_kategori']) {
																						echo "selected";
																					}
																					?>><?= $data["nama_kategori"] ?></option>
									<?php
									}
									?>
								</select>
							</form>
						</div>
						<div class="row">

							<?php foreach ($select as $post) : ?>


								<div class="col-12 col-md-4">
									<div class="card">
										<img class="card-img-top img-fluid " src="../../imgpost/<?= $post['image_post']; ?>" style="
								width: 350px;
								height: 350px;
								object-fit: cover;
								object-position: center;
								">
										<div class="card-header" style="margin-bottom: -40px;">
											<h5 class="card-title"><?= $post['judul']; ?></h5>
											<a href="post.php?id_post= <?= $post["id_post"]; ?>" style="color: #6f6d6f; font-family: sans-serif;"><?php echo substr($post['deskripsi'], 0, 50); ?>...</a>
										</div>
										<div class="card-body">
											<a href="update-post.php?id_post= <?= $post["id_post"]; ?>" class="btn btn-primary">Edit</a>
											<a href="delete-post.php?id_post=<?= $post["id_post"] ?>" class="btn btn-primary delpost">Delete</a>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
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
			$('.delpost').on('click', function() {
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