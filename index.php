<?php 
include "./koneksi/conn.php";
session_start();
$title = "ELITE";

$siswa = mysqli_query($conn, "SELECT * FROM tb_user WHERE NOT id_role = 1 AND NOT id_role = 5");
$banyak_s = mysqli_num_rows($siswa);
$post = mysqli_query($conn, "SELECT * FROM tb_post WHERE id_kategori = 1");
$acv = mysqli_num_rows($post);
$alumni = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_role = 5");
$banyak_i = mysqli_num_rows($alumni);
?>
<!DOCTYPE html>

<html lang="en">

<head>
 <title><?= $title; ?></title>
<?php include "./koneksi/template/head.php"; ?>

</head>

<body>

<!-- section -->
  <?php include "./koneksi/template/section.php"; ?>
<!-- end section -->

<!-- ======= Header ======= -->
  <?php include "./koneksi/template/navbar.php"; ?>
<!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1 style="font-size: 45px;">Ekstrakurikuler Robotika<span> SMKN 2 Surabaya</span></h1>
      <h2>ELITE: ELECTRONIC INOVATION CENTER</h2>
      <div class="d-flex">
        <a href="./history.php" class="btn btn-warning scrollto history"
        style="
        font-family: 'Roboto', sans-serif;
  text-transform: uppercase;
  font-weight: 500;
  font-size: 14px;
  letter-spacing: 1px;
  display: inline-block;
  padding: 10px 28px;
  border-radius: 4px;
  transition: 0.5s;
  color: #fff;
  
        "
        >History ELITE</a>
        <a href="https://www.youtube.com/watch?v=2UcOqkqWk08&t=24s" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
      </div>
    </div>
  </section><!-- End Hero -->

      <!-- ======= About Section ======= -->
    <!-- <section id="about" class="about section-bg">
      <div class="container">

        <div class="section-title">
          <h2>About</h2>
          <h3>About<span> ELITE</span></h3>
          <p></p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <img src="assets/img/about-1.jpg" class="img-fluid" alt="" height="200px">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos-delay="100">
            <h3 class="text-center">Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            </p>          
          </div>
        </div>

      </div>
    </section> -->

    <section id="counts" class="counts">
      <div class="container">

        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="count-box"  style="background-color:#fff9de">
              <i class="bi bi-people-fill"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?= $banyak_s ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Siswa Terdaftar</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
            <div class="count-box"  style="background-color:#fff9de">
              <i class="bi bi-trophy"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?= $acv ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Total Juara</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box" style="background-color:#fff9de">
            <i class="bi bi-person-dash-fill"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?= $banyak_i ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Alumni Terdata</p>
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- End About Section -->
    <section id="about" class="about section-bg">
      <div class="container">

        <div class="section-title">
          <h2>About</h2>
          <h3>Glimpse Of <span>ELITE</span></h3>
          <p>Electronic Inovation Center</p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <img src="assets/img/about.jpeg" class="img-fluid" alt="" width="80%">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos-delay="100">
            <h3>What's The ELITE?</h3>
            <p class="fst-italic">
              ELITE atau Electronic Inovation Center merupakan nama dari ekstrakulikuler robotika di SMK Negeri 2 Surabaya.
            </p>
            <p>
              Pada Ekstrakulikuler robotika atau yang sering dikenal dengan nama ELITE ini merupakan ekstrakulikuler yang mempelajari mengenai bidang teknologi, elektronika, serta robotika. Dengan tenaga pengajar alumni dari SMK Negeri 2 Surabaya serta alumni ektrakulikuler robotika, membuat ELITE selalu berinovasi dan berkembang dalam bidangnya.
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->
   <!-- End Counts Section -->


  <main id="main">

  </main><!-- End #main -->

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