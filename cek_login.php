<?php
session_start();
include "./koneksi/conn.php";

if (isset($_POST["login"])) {
  unset($_SESSION['error']);
  $email = $_POST["email"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email' ");
  $uservalid = mysqli_num_rows($result);

  //cek username
  if ($uservalid  != null) {
    //cek password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {
      
      $_SESSION['login'] = $row; 
      if ($row['id_role'] === "6") {
        $_SESSION['error'] = 'role6';
        echo "<script>
            document.location='./login/'
        </script>";
        // header('location:./login/');
      }elseif ($row['id_role'] === "7") {
        echo "<script>
        alert('Permintaan Anda Ditolak, Data Anda Akan Terhapus 7 Hari Kemudian Dari Anda Login');
        </script>";
        header('location:./login/');
      }
      elseif ($_SESSION['login']['id_role'] === "1") {
        header('location:dashboard/admin-page/');
        unset($_SESSION['error']);
        exit;
      } elseif ($_SESSION['login']['id_role'] === "2") {
        header('location:dashboard/inventaris-page/');
        unset($_SESSION['error']);
        exit;
      } elseif ($_SESSION['login']['id_role'] === "4") {
        header('location:dashboard/member-page/');
        unset($_SESSION['error']);
        exit;
      } elseif ($_SESSION['login']['id_role'] === "3") {
        header('location:dashboard/bendahara-page/');
        unset($_SESSION['error']);
        exit;
      }elseif ($_SESSION['login']['id_role'] === "5") {
        header('location:dashboard/alumni-page/');
        unset($_SESSION['error']);
        exit;
      }

    }else {
      $error = true;
      if (isset($error)) {
        $_SESSION['error'] = 'password';
        echo "
        <script>
        document.location='./login/'
        </script>";
      }
    }
  } else {
    $error = true;
    if (isset($error)) {
      $_SESSION['error'] = 'email';
      echo "<script>
        document.location='login/'
        </script>";
    }
  }
}
