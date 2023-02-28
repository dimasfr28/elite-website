<?php
session_start();

if (!isset($_SESSION['login'])) {
	header('location:../login/');
	exit;
}
if ($_SESSION['login']['id_role'] != 2 ) {
  echo "<script>
  alert('Your Role Not Inventaris!');
  document.location='../../login/'
  </script>";
      exit;
}