<?php
include "../../koneksi/conn.php";
include "./function/session.php";
include "./function/add_user.php";

if (isset($_POST['adduser'])) {

  if (registrasi($_POST) > 0) {
    echo "<script>window.location.href = '../admin-page';</script>";
  } else {
    echo mysqli_error($conn);
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../template/head.php" ?>
  <title>Dashboard | Add User</title>
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
          icon: 'error',
          title: 'Ukuran File Terlalu Besar!',
          showConfirmButton: false,
          timer: 1500
        })
      } else if (status == 'email') {
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Email Sudah Terdaftar!',
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
  } else if (@$_SESSION['data-success'] == "email") { ?>
   <script>
      showAlert('email')
    </script>
    <?php  
  unset($_SESSION['data-success']);  
  } 
    ?>

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
              <i class="align-middle" data-feather="edit"></i>Add User Data
            </h5>
            <hr>

            <form method="post" enctype="multipart/form-data">

              <div class="row g-2">
                <div class="col-md">
                  <h5 class="card-title mb-0" class="form-label" for="nama_lengkap" style="color: #6d6d6d;">
                    <label for="nama_lengkap" class="form-label" style="font-size: 20px;">*Nama lengkap</label>
                  </h5>

                  <div class="form-floating">
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama lengkap user" required>
                    <label for="nama_lengkap">Nama lengkap user</label>
                  </div>
                </div>

                <div class="col-md">
                  <h5 class="card-title mb-0" class="form-label" for="email" style="color: #6d6d6d;">
                    <label for="email" class="form-label" style="font-size: 20px;">*Email</label>
                  </h5>
                  <div class="form-floating">
                    <input type="email" class="form-control" required id="email" name="email" placeholder="name@example.com">
                    <label for="email">Email User</label>
                  </div>
                </div>
              </div>
              <div class="row g-2 mt-3">
                <div class="col-md">
                  <h5 class="card-title mb-0" class="form-label" for="id_role" style="color: #6d6d6d;"><label for="id_role" class="form-label" style="font-size: 20px;">*Role</label>
                  </h5>
                  <div class="form-floating">
                    <select class="form-select" id="id_role" name="id_role">
                      <?php
                      $kuer2 = mysqli_query($conn, "SELECT * FROM tb_role WHERE id_role = '2' OR id_role = '3' OR id_role = '4' OR id_role = '5'");
                      while ($data3 = mysqli_fetch_array($kuer2)) {
                        echo '
				<option value="' . $data3["id_role"] . '" id="id_kelas" name="id_role"';
                        echo '>' . $data3["nama_role"] . '</option>';
                      }
                      ?>
                    </select>
                    <label for="id_role">Pilih Role</label>
                  </div>
                </div>
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

                <input class="form-control form-control-lg" required id="image_profile" name="image_profile" type="file">

                <h5 class="card-title mb-0 mt-4" class="form-label" for="password" style="color: #6d6d6d;">
                  <label for="password" class="form-label" style="font-size: 20px;">*Password</label>
                </h5>
                <div class="form-floating">
                  <input type="password" class="form-control" id="password" name="password" minlength="8" required>
                  <label for="password">Update Password User</label>
                </div>
              </div>

          </div>

          <div class="col-sm-5 row pb-1" style="margin-left: 29%;">
            <button type="submit" class="btn btn-primary btn-lg" name="adduser" style="color: white;">Add User</button>
          </div>
          <div class="row pb-5" style="text-align: center;">
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

</body>

</html>