<?php 

include "../../function.php";
session_start();

$user_id = $_SESSION['login']['id_user'];

$select = mysqli_query($conn, "SELECT * FROM tb_cart WHERE id_user = $user_id");

$assoc = mysqli_num_rows($select);

echo (int)$assoc;


?>