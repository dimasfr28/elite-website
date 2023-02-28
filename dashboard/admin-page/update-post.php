<?php


include "../../function.php";
include "./function/session.php";

if (isset($_POST['update'])) {
  if (updatepost($_POST) > 0) {
    $_SESSION['data-success'] = "updatepost";
    echo "<script>
        document.location.href = 'post-admin.php';
        </script>";
  } else {
    echo mysqli_error($conn);
  }
}
$id_post = $_GET["id_post"];

$data = query("SELECT * FROM tb_post WHERE id_post = $id_post")[0];

$tb_user = query("SELECT tb_kelas.nama_kelas, tb_role.nama_role FROM tb_user LEFT JOIN tb_kelas ON tb_user.id_kelas = tb_kelas.id_kelas LEFT JOIN tb_role ON tb_user.id_role = tb_role.id_role");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../template/head.php" ?>
  <title>Dashboard | Update Post</title>
</head>

<body>
  <div class="wrapper">

    <?php include "../template/sidebar.php" ?>

    <div class="main" style="background-color:#dbdad9;">
      <nav class="navbar navbar-expand navbar-light navbar-bg">
        <?php include "../template/navbardashboard.php"; ?>
      </nav>

      <div class="container mt-3" style="background-color: #dbdad9;">


        <div class="card flex-fill mt-4" style="border-radius: 20px;">
          <div class="card-header" style="border-radius: 20px;">

            <h5 class="card-title mb-0">
              <i class="align-middle" data-feather="plus-square"></i> Add New Post
            </h5>
            <hr>

            <form method="post" enctype="multipart/form-data">

              <input type="hidden" name="id_post" id="id_post" required value="<?= $data["id_post"] ?>">
              <input type="hidden" name="fotoLama" required value="<?= $data["image_post"] ?>">

              <div class="row g-2">
                <div class="col-md">


                  <h5 class="card-title mb-0" class="form-label" for="judul" style="color: #6d6d6d;">
                    <label for="judul" class="form-label" style="font-size: 20px;">*Judul</label>
                  </h5>

                  <div class="form-floating">
                    <input required type="text" class="form-control" id="judul" name="judul" placeholder="Judul Post" value="<?= $data["judul"] ?>">
                    <label for="judul">Judul Post</label>
                  </div>
                </div>

                <div class="col-md">
                  <h5 class="card-title mb-0" class="form-label" for="id_kategori" style="color: #6d6d6d;"><label for="id_kategori" class="form-label" style="font-size: 20px;">*Kategori</label>
                  </h5>
                  <div class="form-floating">
                    <select class="form-select" id="id_kategori" name="id_kategori">
                      <option selected>Select Category Post</option>
                      <?php
                      $kuer2 = mysqli_query($conn, "SELECT * FROM tb_kategori_post");
                      while ($data3 = mysqli_fetch_array($kuer2)) {
                        echo '
                <option value="' . $data3["id_kategori"] . '" id="id_kelas" name="id_kategori"';
                        if ($data["id_kategori"] == $data3["id_kategori"]) {
                          echo 'selected';
                        }
                        echo '>' . $data3["nama_kategori"] . '</option>';
                      }
                      ?>
                    </select>
                    <label for="id_role">Pilih Kategori</label>
                  </div>
                </div>

              </div>

              <div class="row ">
                <div class="col-md">


                  <h5 class="card-title mb-0 mt-3" class="form-label" for="tgl_post" style="color: #6d6d6d;">
                    <label for="tgl_post" class="form-label" style="font-size: 20px;">*Date</label>
                  </h5>

                  <div class="form-floating">
                    <input required type="date" class="form-control" id="tgl_post" name="tgl_post" placeholder="tgl_post Post" style="height: 30%;" value="<?= $data["tgl_post"] ?>">
                    <label for="tgl_post">Date Post</label>
                  </div>
                </div>
                <div class="col-md">
                  <h5 class="card-title mb-0 mt-3" class="form-label" for="image_post" style="color: #6d6d6d;">
                    <label for="image_post" class="form-label" style="font-size: 20px;">*Image Post</label>
                  </h5>

                  <input class="form-control form-control-lg mt-3" id="image_post" name="image_post" type="file">
                </div>

                <div class="mb-3">
                  <h5 class="card-title mb-0 mt-4" class="form-label" for="deskripsi" style="color: #6d6d6d;">
                    <label for="deskripsi" class="form-label" style="font-size: 20px;">*Deskripsi</label>
                  </h5>
                  <textarea required name="deskripsi" id="deskripsi" class="form-control" required> <?= $data["deskripsi"] ?></textarea>
								</div>

                                
</div>

<div class="col-sm-5 row pb-1" style="margin-left: 29%;">
 <button type="submit" class="btn btn-primary btn-lg" name="update" style="color: white;">update</button>
 </div>
   <div class="row pb-2" style="text-align: center;">
 </div>
 
</form>
</div>
								</div>
								
							</div>
						</div>
			</div>
			
		</div>
	</div>

  <script src="./js/app.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
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