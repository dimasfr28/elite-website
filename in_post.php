<?php 

include "./koneksi/conn.php";
$title = "In Post";
$id_post = $_GET["id_post"];
$dataPost = mysqli_query($conn, "SELECT * FROM tb_post WHERE id_post ='$id_post'");
$dataPost1 = mysqli_fetch_assoc($dataPost);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>ELITE | <?= $title ?></title>
<?php include "./koneksi/template/head.php"; ?>

</head>

<body>

<!-- section -->
  <?php include "./koneksi/template/section.php"; ?>
<!-- end section -->

<!-- ======= Header ======= -->
  <?php include "./koneksi/template/navbar.php"; ?>
<!-- End Header -->

<div class="d-flex"  style="background-color: rgba(245, 115, 0, 0.12);">
<div class="container">
  <p class="p-2 mt-4 mb-4 fs-3 fw-semibold text-secondary">ELITE / <?= $title ?></p>
  </div>
</div>

<section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up" style="background-color: #fff4e2; border-radius:20px;">      
        <div class="row">
    <div class="col-sm-7 mt-3 text-center mb-3" >
		<img class="card-img-top" src="./imgpost/<?= $dataPost1['image_post'];?>" alt="Unsplash" style="
								width: 380px;
								height: 380px;
								object-fit: cover;
								object-position: center;

		">
	</div>
    <div class="col-sm-5" style="font-family: sans-serif;">
	<h6 class="card-title text-center mt-4 fs-1">ELITE POST</h6>
			<p class="fw-bolder text-capitalize fs-3 mt-4"><?= $dataPost1['judul'] ?>...</p>
			<p class="fw-lighter fs-6"><?= $dataPost1['deskripsi'] ?></p>


	</div>

	<a href="  <?php 
  $yourkt = $dataPost1['id_kategori'];
  if($yourkt == 1){
    echo './achievement.php';
  } elseif($yourkt != 1){
    echo './post.php';
  }?>" class="btn btn-secondary align-bottom">Back</a>
        </div>
      </div>
    </section><!-- End Team Section -->


 <?php include "./koneksi/template/footer.php"; ?>
 
  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>