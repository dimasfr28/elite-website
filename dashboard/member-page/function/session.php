<?php
session_start();

if (!isset($_SESSION['login'])) {
	header('location:../login/');
	exit;
}
if ($_SESSION['login']['id_role'] != 4 ) {
  echo "<script>
  alert('Your Role Not Siswa!');
  document.location='../../login/'
  </script>";
      exit;
}