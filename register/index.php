<?php
session_start();
require '../function.php';
require './daftar.php';

if (isset($_POST['daftar'])) {
  if (daftar($_POST) > 0) {
  } else {
    echo mysqli_error($conn);
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>ELITE | Register</title>
  <!-- MDB icon -->
  <link href="../assets/img/logoutama1.png" rel="icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/bootstrap-login-form.min.css" />
</head>

<body>
  <!-- Start your project here-->
  <section class="w-100" style="background-color: #ffc116">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="23811.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; margin-top: 120px;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <span class="h1 fw-bold mb-0 text-warning">ELITE</span>
                  </div>
                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px">Daftarkan Diri Anda Dengan Mengisi Form Dibawah</h5>
                  <?php 
                  if (@$_SESSION['success'] == 'daftar') {
                    echo " <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Pendaftaran Berhasil!</strong> Silahkan <a href='../login/' class='text-dark'>Cek Akun Anda!</a>
                   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                 </div>";
                  }
                  unset($_SESSION['success']);
                  ?>
                  <?php  
                  if (@$_SESSION['error'] == 'email') {
                    echo " <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Email Sudah Terdaftar!</strong> Gunakan Email Lain! 
                   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                 </div>";
                  }
                  unset($_SESSION['error']);
                  ?>
                  
                  <form class="form-floating" method="post" enctype="multipart/form-data">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="nama lengkap" autocomplete="off">
                      <label for="nama_lengkap">Nama Lengkap</label>
                      <select class="form-select form-select-lg" aria-label=".form-select-sm example" name="id_kelas">>
                        <option selected>pilih kelas</option>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM tb_kelas");
                        foreach ($query as $key) {
                        ?>
                          <option value="<?= $key["id_kelas"] ?>" name="id_kelas"><?= $key["nama_kelas"] ?></option>
                        <?php } ?>
                      </select>
                      <input class="form-control" type="file" name="image_profile">
                      <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" autocomplete="off">
                        <label for="email">Email address</label>
                        <div class="form-floating mb-3">
                          <input type="password" class="form-control" id="password" minlength="8" name="password" placeholder="Password" autocomplete="off">
                          <label for="password">Password</label>
                        </div>
                        <div class="pt-1 mb-2">
                          <button class="btn btn-dark btn-lg btn-block" type="submit" name="daftar">Login</button>
                        </div>
                  </form>
                  <p style="color: #393f81">Sudah Mempunyai Akun? <a href="../login/" style="color: #393f81">Login</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End your project here-->

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</body>

</html>