<?php
include "../../function.php";
session_start();

if (!isset($_SESSION['login'])) {
  header('location:../login/');
  exit;
}

if (isset($_POST['soloupdate'])) {
  if (yourprofile($_POST) > 0) {
    // header('location: ./profile.php');
  } else {
    echo mysqli_error($conn);
  }
}
$user_id = $_SESSION['login']['id_user'];
$select = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = $user_id");
mysqli_fetch_assoc($select);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "head.php" ?>
  <title>Dashboard | Edit Profile</title>
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
  } ?>
  <div class="wrapper">

    <?php include "./sidebar.php" ?>

    <div class="main">
      <nav class="navbar navbar-expand navbar-light navbar-bg">
        <?php include "./navbardashboard.php"; ?>
      </nav>

      <main class="content">
        <div class="container-fluid p-0">

          <div class="row d-flex justify-content-center">
            <div class="col-6 shadow-lg p-3 mb-5 bg-body rounded">
              <div class="card flex-fill">
                <div class="card-header bg-dark">
                  <h5 class="card-title mb-0"><i class="align-middle" data-feather="edit"></i> Profile</h5>
                </div>
                <div class="card-body">
                  <?php
                  foreach ($select as $key) {
                  ?>
                    <form method="post" enctype="multipart/form-data">
                      <input type="hidden" name="password_lama" id="password_lama" required value="<?= $key['password'] ?>">
                      <input type="hidden" name="id_user" id="id_user" required value="<?= $key['id_user'] ?>">
                      <input type="hidden" name="fotoLama" required value="<?= $key['image_profile'] ?>">

                      <div class="row g-2">
                        <div class="col-md">
                          <h5 class="card-title mb-0" class="form-label" for="Nama-lengkap" style="color: #6d6d6d;">
                            <label for="Nama-lengkap" class="form-label" style="font-size: 20px;">*Nama lengkap</label>
                          </h5>

                          <div class="form-floating">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama lengkap user" value="<?= $key['nama_lengkap'] ?>">
                            <label for="nama_lengkap">Nama lengkap user</label>
                          </div>
                        </div>

                        <div class="col-md">
                          <h5 class="card-title mb-0" class="form-label" for="email" style="color: #6d6d6d;">
                            <label for="email" class="form-label" style="font-size: 20px;">*Email</label>
                          </h5>
                          <div class="form-floating">
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?= $key['email'] ?>">
                            <label for="email">Email User</label>
                          </div>
                        </div>
                      </div>
                      <div class="row g-2 mt-3">
                        <div class="col-md">
                          <h5 class="card-title mb-0" class="form-label" for="id_kelas" style="color: #6d6d6d;"><label for="id_kelas" class="form-label" style="font-size: 20px;">*Kelas</label>
                          </h5>
                          <div class="form-floating">
                            <select class="form-select" id="id_kelas" name="id_kelas">
                              <?php
                              $kuer2 = mysqli_query($conn, "SELECT * FROM tb_kelas");
                              while ($data3 = mysqli_fetch_array($kuer2)) {
                                echo '
											<option value="' . $data3["id_kelas"] . '" id="id_kelas" name="id_kelas"';
                                if ($key['id_kelas'] == $data3["id_kelas"]) {
                                  echo 'selected';
                                }
                                echo '>' . $data3["nama_kelas"] . '</option>';
                              }
                              ?>
                            </select>
                            <label for="id_kelas">Pilih Kelas</label>
                          </div>
                        </div>
                        <h5 class="card-title mb-0 mt-4" class="form-label" for="image_profile" style="color: #6d6d6d;">
                          <label for="image_profile" class="form-label" style="font-size: 20px;">*Image Profile</label>
                        </h5>

                        <img src="../../profile/<?= $key['image_profile'] ?>" style="width: 200px;" class="imgPreview">
                        <br>
                        <input class="form-control form-control-lg imgInput" id="image_profile" name="image_profile" type="file" onchange="readURL(this);" />

                        <h5 class="card-title mb-0 mt-4" class="form-label" for="password" style="color: #6d6d6d;">
                          <label for="password" class="form-label" style="font-size: 20px;">*Password</label>
                        </h5>
                        <div class="form-floating">
                          <input type="password" class="form-control" id="password" name="password">
                          <label for="password">Update Password User</label>
                        </div>
                      </div>

                </div>

                <div class="col-sm-5 row pb-1" style="margin-left: 29%;">
                  <button type="submit" class="btn btn-primary btn-lg" name="soloupdate" style="color: white;">Update</button>
                </div>
                <div class="row pb-5" style="text-align: center;">
                </div>
                </form>
              <?php
                  }
              ?>

              </div>
            </div>
          </div>
        </div>




      </main>
      <?php include "footer.php"; ?>
    </div>
  </div>


  <script src="./js/app.js"></script>




</body>

</html>