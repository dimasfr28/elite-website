<?php 

session_start();
unset($_SESSION['']);

session_destroy();
echo "<script>document.location='../../login/index.php'</script>";
 ?>