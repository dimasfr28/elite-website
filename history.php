<?php 
$title = "History";
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
 

      <!-- ======= About Section ======= -->
    <section id="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <img src="assets/img/about-1.jpg" class="img-fluid mt-4" alt="" height="300px">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-center">The History Of ELITE</h3>
            <p class="fst-italic">
            <strong>ELITE</strong> atau Electronic Inovation Center merupakan nama ekstrakulikuler robotika di <strong>SMK Negeri 2 Surabaya.</strong> <strong>ELITE</strong>  berdiri sejak 10 Oktober 2010, dan saat ini sudah menginjak tahun ke 13 sejak berdiri.
            </p>
            <p class="fst-italic">
               Sebelum terbentuknya <strong>ELITE,</strong> ekstrakulikuler robotika SMK Negeri 2 Surabaya Bernama <strong>ERAVCO</strong> atau Education Robotik Audio Vidio Comunity. Pada era <strong>ERAVCO</strong> ekstrakulikuler robotika di <strong>SMKN Negeri 2 Surabaya</strong> hanya menerima siswa dari kejuruan <strong>Teknik Audio Vidio(Elektronika)</strong> saja.
               Lalu pada saat <strong>ERAVCO</strong> dibubarkan,  <strong>Ade Ervan</strong> dan <strong>Syafii</strong> mendirikan <strong>ELITE</strong> pada 10 Oktober 2010. Setelah <strong>ELITE</strong> beridiri, Ekstrakulikuler robotika di <strong>SMK Negeri 2 Surabaya</strong> menerima siswa dari berbagai jurusan. Sampai saat ini<strong>ELITE</strong> masih berkembang dengan mengandalkan tenaga pengajar dari alumni <strong>ELITE</strong> sendiri dan menddapatkan prestasi yang semakin meningkat setiap tahunnya.
            </p> 
          </div>
        </div>

      </div>
    </section><!-- End About Section -->


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