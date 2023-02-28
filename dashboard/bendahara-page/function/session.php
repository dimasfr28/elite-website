<?php
session_start();

if (!isset($_SESSION['login'])) {
	header('location:../../login/');
	exit;
}

if ($_SESSION['login']['id_role'] != 3 ) {
  echo "<script>
  alert('Your Role Not Bendahara!');
  document.location='../../login/'
  </script>
  ";
}