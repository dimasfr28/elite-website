<?php

include "./koneksi/conn.php";
include "./koneksi/function/post.php";
$title = "Post";
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

    <div class="d-flex" style="background-color: rgba(245, 115, 0, 0.12);">
        <div class="container">
            <p class="p-2 mt-4 mb-4 fs-3 fw-semibold text-secondary">ELITE / <?= $title ?></p>
        </div>
    </div>


    <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Post</h2>
                <h3>Post <span>ELITE</span></h3>
                <form method="post" class="justify-content-center mx-auto mt-1" style="width: 15%;">
                    <select class="form-select" aria-label="Default select example"  name="select" id="select" onchange="this.form.submit()">
                        <option value="all">All</option>
                    <?php $select = mysqli_query($conn, "SELECT * FROM tb_kategori_post WHERE NOT id_kategori = 1");
                    foreach ($select as $kategori) {
                    ?>
                        <option value="<?= $kategori['id_kategori'] ?>"
                        <?php 
						if (@$_POST['select'] == $kategori['id_kategori']) {
							echo "selected";
						}
						?>
                        ><?= $kategori['nama_kategori'] ?></option>
                    <?php } ?>
                      </select>
                </form>
            </div>

            <div class="row">
                <?php
                $post = @$_POST['select'];
                if ($post == 'all') {
                    $acv = mysqli_query($conn, "SELECT * FROM tb_post WHERE NOT id_kategori = 1 LIMIT $halaman_awal, $batas");
                }elseif ($post != null) {
                    $acv = mysqli_query($conn, "SELECT * FROM tb_post WHERE id_kategori LIKE '%$post%' LIMIT $halaman_awal, $batas");
                }elseif (@$post == null) {
                    $acv = mysqli_query($conn, "SELECT * FROM tb_post WHERE NOT id_kategori = 1 LIMIT $halaman_awal, $batas");
                }
                
                foreach ($acv as $key) {
                ?>
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <div class="member-img">
                                <img src="./imgpost/<?= $key['image_post'] ?>" class="img-fluid" alt="" style="
								width: 350px;
								height: 350px;
								object-fit: cover;
								object-position: center;
								">
                            </div>
                            <div class="member-info">
                                <a href="in_Post.php?id_post=<?=$key["id_post"];?>">
                                    <h4><?= $key['judul'] ?></h4>
                                </a>
                                <span><?= substr($key['deskripsi'], 0, 50); ?>...</span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

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