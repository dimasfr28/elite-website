<?php 

include "../../../function.php";

// mengaktifkan sesion
session_start();

// sesion untuk login
if (!isset($_SESSION['login'])) {
	header('location:../../../login.php');
	exit;
}

$select_barang = mysqli_query($conn, "SELECT * FROM tb_inventory");

if (isset($_POST['cart'])) {
    if (addcart($_POST) > 0) {
        header('location:cart.php');
    } else {
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
        <style>
            table, th, td{
                border: 1px solid black;
            }
        </style>
    <table>
        <tr>
            <th>no</th>
            <th>nama</th>
            <th>jumlah</th>
            <th>aksi</th>
        </tr>
    <?php 
    foreach ($select_barang as $barang) {
        $no = 1;
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $barang["nama_barang"] ?></td>
        <td><?= $barang["jumlah"] ?></td>
        <td>
        <form action="" method="post">
            <input type="hidden" name="id_barang" value="<?= $barang["id_barang"] ?>">
            <input type="hidden" name="jumlah" value="1">
            <input type="hidden" name="id_user" value="<?= $_SESSION['login']['id_user'] ?>">
            <button type="submit" class="btn btn-primary" name="cart">Add to cart</button>
        </td>
        </form>
    </tr>
    <?php 
    }
    ?>
    </table>
</body>
</html>