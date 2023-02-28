<?php
session_start();
require '../function.php';

if (isset($_SESSION['login'])) {
  if ($_SESSION['login']['id_role'] == "1") {
    header('location:../dashboard/admin-page/');
    exit;
  } elseif ($_SESSION['login']['id_role'] == "2") {
    header('location:../dashboard/inventaris-page/');
    exit;
  } elseif ($_SESSION['login']['id_role'] == "3") {
    header('location:../dashboard/bendahara-page/');
    exit;
  } elseif ($_SESSION['login']['id_role'] == "4") {
    header('location:../dashboard/member-page/');
    exit;
  } elseif ($_SESSION['login']['id_role'] == "5") {
    header('location:../dashboard/alumni-page/');
    exit;
  } elseif ($_SESSION['login']['id_role'] == "6") {
    session_destroy();
  } elseif ($_SESSION['login']['id_role'] == "7") {
    session_destroy();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>ELITE | Login</title>
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
  <section class="vh-100" style="background-color: #ffc116">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="23811.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; margin-top: 80px;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <span class="h1 fw-bold mb-0 text-warning">ELITE</span>
                  </div>
                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px">Please Login..</h5>
                  <?php  
                  if (@$_SESSION['error'] == 'password') {
                   echo " <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   Password Salah!
                   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                 </div>";
                  }elseif (@$_SESSION['error'] == 'role6') {
                    echo " <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                   <strong>Akun Sedang Diproses</strong> Tunggu Admin Menyetujui Permintaan Anda!
                   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                 </div>";
                  }elseif (@$_SESSION['error'] == 'email') {
                    echo " <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Email Belum Terdaftar!</strong> Silahkan Melakukan Registrasi
                   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                 </div>";
                  }else{
                    echo "";
                  }
                  unset($_SESSION['error']);
                  ?>
                  <form class="form-floating" method="post" action="../cek_login.php">
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" autocomplete="off">
                      <label for="email">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
                      <label for="password">Password</label>
                    </div>
                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit" name="login">Login</button>
                    </div>
                  </form>
                  <p class="mb-5 pb-lg-2" style="color: #393f81">Ingin Bergabung Di ELITE? <a href="../register/" style="color: #393f81">Register</a></p>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</body>

</html>