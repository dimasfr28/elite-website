<?php
session_start();

if (!isset($_SESSION['login'])) {
	header('location:../../login/');
	exit;
}
if ($_SESSION['login']['id_role'] != 1 ) {
  echo "<script>
  alert('Your Role Not Admin!');
  document.location='../../login/'
  </script>
  ";
}
?>