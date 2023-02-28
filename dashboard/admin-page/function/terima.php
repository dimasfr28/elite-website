
<?php
include "../../../koneksi/conn.php";
$id_user = @$_GET['id_user']; 
date_default_timezone_set('Asia/Jakarta');
    $tanggal = date("j F Y");

$query = "UPDATE tb_user SET
            id_role = '4'
            WHERE id_user = '$id_user'
";
mysqli_query($conn, $query);




$inputkas = mysqli_query($conn, "INSERT INTO tb_kas_siswa VALUES('', '$id_user', '0', '$tanggal')");

?>

<meta http-equiv="refresh" content="0;url=http://localhost/elite1010/dashboard/admin-page/pendaftaran.php" />