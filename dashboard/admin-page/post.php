<?php 


include "../../koneksi/conn.php";
include "./function/session.php";

$id_post = $_GET["id_post"];

$dataPost = mysqli_query($conn, "SELECT * FROM tb_post WHERE id_post = $id_post");

// query left join tabel


 ?>
<!DOCTYPE html>
<html lang="en">

<head> 
	<?php include "../template/head.php" ?>
	<title>Dashboard | In Post</title>
</head>

<body>
<div class="wrapper">
		
		<?php include "../template/sidebar.php" ?>

		<div class="main" style="background-color: #dbdad9;">
		<nav class="navbar navbar-expand navbar-light navbar-bg">
			<?php include "../template/navbardashboard.php";?>
		</nav>

			<div class="container mt-1" style="width: 70%;">
				<div class="card flex-fill mt-4" style="border-radius: 20px;">
								
									<div class="container">
										<?php  
										foreach ($dataPost as $dataPost1) {
										?>
  <div class="row">
    <div class="col-sm-7 mt-3 text-center mb-3" >
		<img class="card-img-top mt-1" src="../../imgpost/<?= $dataPost1['image_post'];?>" alt="Unsplash" style="
								width: 380px;
								height: 380px;
								object-fit: cover;
								object-position: center;

		">
	</div>
    <div class="col-sm-5" style="font-family: sans-serif;">
	<h6 class="card-title text-center mt-4 fs-1">ELITE POST</h6>
			<p class="fw-bolder text-capitalize fs-3 mt-4"><?= $dataPost1['judul'] ?></p>
			<p class="fw-lighter fs-6"><?= $dataPost1['deskripsi'] ?></p>


	</div>
	<a href="./post-admin.php" class="btn btn-secondary align-bottom">Back</a>
  </div>
  <?php } ?>
	</div>
						</div>
			</div>
			
		</div>
	</div>
  <script src="../js/app.js"></script>
</body>

</html>