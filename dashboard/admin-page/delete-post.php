<?php
include "../../function.php";
$id_post = @$_GET['id_post'];

$sql = "SELECT * FROM tb_post WHERE id_post = '$id_post'";
$query = mysqli_query($conn, $sql);
$execute = mysqli_fetch_assoc($query);
unlink("../../imgpost/" . $execute['image_post']);

$abc = "DELETE FROM tb_post WHERE id_post = '$id_post' ";
$query = mysqli_query($conn, $abc);

?>
<meta http-equiv="refresh" content="0;url=post-admin.php" />