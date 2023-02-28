<?php 

include "../../../function.php";

// mengaktifkan sesion
session_start();

// sesion untuk login
if (!isset($_SESSION['login'])) {
	header('location:../../../login.php');
	exit;
}

$user_id = $_SESSION['login']['id_user'];
// $cart = mysqli_query($conn, "SELECT * FROM tb_cart WHERE id_user = '$user_id' ");
$cart2 = mysqli_query($conn, "SELECT tb_cart.jumlah, tb_cart.id_barang, tb_cart.id_user, tb_inventory.id_barang, tb_inventory.nama_barang, tb_inventory.jumlah as jmlInv FROM tb_cart INNER JOIN tb_inventory ON tb_cart.id_barang = tb_inventory.id_barang WHERE tb_cart.id_user = $user_id");


if (isset($_POST['addpeminjaman'])) {
    if (addpeminjaman($_POST) > 0) {
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <table class="table table-hover my-0">
        <thead>
        <tr>            
            <th>no</th>
            <th>id_barang</th>
            <th>jumlah</th>
            <th>aksi</th>
        </tr>
        </thead>
        <tbody>
    <?php 
        $i = 1;
    foreach ($cart2 as $key) {
    ?>
    <tr>
    <td><?= $i++; ?></td>
    <td><?=$key["nama_barang"] ?></td>
            <?php 
                $from_inv = $key['id_barang'];
                include './max.php';
                $from_dipinjam = isset($assoc['id_barang']);
                if ($from_inv == $from_dipinjam) {
                    $pengurangan = (int)$key['jmlInv'] - (int)$assoc['jumlah'];
                } else if($from_dipinjam == null) {
                    $pengurangan = (int)$key['jmlInv'] + 0;
                }
            ?>
        <form action="./update_cart.php" method="POST" id="submit_form">
            <input type="hidden" name="id_barang" value="<?= $key["id_barang"] ?>">
            <input type="hidden" name="id_user" value="<?= $user_id; ?>">
            <td><input type="number" name="jumlah" id="jumlah" value="<?= $key['jumlah'] ?>" max="<?= $pengurangan; ?>" class="qty"></td>
            <td></td>
            <!-- <td><button type="submit" name="updatecart">update</button></td> -->
        </form>
    </tr>
    <?php 
    }
    
    ?>
    <form action="pembelian.php" method="POST">
        <input type="hidden" name="id_user" value="<?= $user_id; ?>">
        <div class="d-grid gap-2 col-6 mx-auto">
  <button class="btn btn-primary mt-3" type="submit" name="addpeminjaman">Pinjam</button>
    </form>
    </tbody>
    
    </table>
    
    </div>
    <script>
        let form = document.querySelector('#submit_form');
        let qty = document.getElementsByClassName("qty");
        
        Array.from(qty).forEach(function(q){
            q.addEventListener('change', debounce(() => q.form.submit()));
        });

        function debounce(func, timeout = 50){
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => { func.apply(this, args) }, timeout);
            };
        }
    </script>
</body>
</html>