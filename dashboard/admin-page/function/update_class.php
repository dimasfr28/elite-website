<?php 

$id_kelas = $_GET["id_kelas"];

$data = mysqli_query($conn, "SELECT * FROM tb_kelas WHERE id_kelas = $id_kelas");

function update_class($data)
{
    global $conn;

    $id_kelas = htmlspecialchars($data["id_kelas"]);
    $nama_kelas  = htmlspecialchars($data["nama_kelas"]);

    
    $sql = mysqli_query($conn, "SELECT * FROM tb_kelas WHERE nama_kelas = '$nama_kelas'");
    $row = mysqli_num_rows($sql);

    if ($row == 0) {
        $query = "UPDATE tb_kelas SET
                nama_kelas = '$nama_kelas'

            WHERE id_kelas = $id_kelas
                ";

    mysqli_query($conn, $query);
    $_SESSION['data-success'] = 'updatekelas';
    echo "<script>
  document.location='../admin-page/class_controll.php'
  </script>";
    }elseif ($row != 0) {
        $_SESSION['data-success'] = 'error';
    }

    

   
}
