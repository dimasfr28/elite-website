<?php 

function addclass($data)
{
    global $conn;

    $nama_kelas = $data["nama_kelas"];

    $sql = mysqli_query($conn, "SELECT * FROM tb_kelas WHERE nama_kelas = '$nama_kelas'");
    $row = mysqli_num_rows($sql);

    if ($row == 0) {
        $simpan = mysqli_query($conn, "INSERT INTO tb_kelas VALUES('', '$nama_kelas')");
        $_SESSION['data-success'] = 'addkelas';
        echo "<script>
        document.location='../admin-page/class_controll.php'
        </script>";
    }elseif ($row != 0) {
        $_SESSION['data-success'] = 'error';
    }

       

   
}
