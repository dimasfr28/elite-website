<?php
include "../../function.php";
include "../../koneksi/conn.php";
include "./function/session.php";
include "./function/update_barang.php";

if (isset($_POST['input'])) {

    if (updateitem($_POST) > 0) {
     
    } else {
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../template/head.php"; ?>
    <title>Dashboard | Update Items</title>
    <script>
		function showAlert(status) {
			if (status == 'error') {
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: 'Ekstensi File Tidak Didukung!',
					showConfirmButton: false,
					timer: 1500
				})
			} else if (status == 'error2') {
				Swal.fire({
					position: 'center',
					icon: 'success',
					title: 'Ukuran File Terlalu Besar',
					showConfirmButton: false,
					timer: 1500
				})
			}
		}
	</script>
</head>

<body>
<?php if (@$_SESSION['data-success'] == "ekstensi") {
	?>
		<script>
			showAlert('error')
		</script>
	<?php
		unset($_SESSION['data-success']);
	} else if (@$_SESSION['data-success'] == "ukuran") { ?>
		<script>
			showAlert('error2')
		</script>
	<?php
		unset($_SESSION['data-success']);
	} ?>

    <div class="wrapper">

        <?php include "../template/sidebar.php" ?>

        <div class="main" style="background-color:#dbdad9;">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <?php include "../template/navbardashboard.php"; ?>
            </nav>

            <div class="container mt-3" style="background-color: #dbdad9;">


                <div class="card flex-fill mt-4" style="border-radius: 20px;">
                    <div class="card-header" style="border-radius: 20px;">

                        <h5 class="card-title mb-0">
                            <i class="align-middle" data-feather="edit"></i> Update Items
                        </h5>
                        <hr>

                        <form method="post" enctype="multipart/form-data">

                            <input type="hidden" name="id_barang" id="id_barang" requizred value="<?= $data["id_barang"] ?>">
                            <input type="hidden" name="fotoLama" required value="<?= $data["foto"] ?>">

                            <div class="row g-2">
                                <h5 class="card-title mb-0" class="form-label" for="barang" style="color: #6d6d6d;">
                                    <label for="barang" class="form-label" style="font-size: 20px;">*Name Of Item</label>
                                </h5>

                                <div class="form-floating">
                                    <input required type="text" class="form-control" id="barang" name="barang" placeholder="Name Of Items" value="<?= $data['nama_barang'] ?>">
                                    <label for="barang">Name Of Items</label>
                                </div>

                            </div>
                            <div class="row g-2 mt-3">
                                <div class="col-md">

                                    <h5 class="card-title mb-0" class="form-label" for="jumlah" style="color: #6d6d6d;">
                                        <label for="jumlah" class="form-label" style="font-size: 20px;">*Lots Of Items</label>
                                    </h5>
                                    <?php
                                    $idb = $data['id_barang'];
                                    $qry = mysqli_query($conn, "SELECT SUM(jumlah) AS jum FROM tb_peminjaman_detail WHERE NOT id_status_p = 2 GROUP BY id_barang");
                                    $inrow = mysqli_num_rows($qry);
                                    $assoc = mysqli_fetch_assoc($qry);
                                    if (@$assoc['jum'] == 0) {
                                        $jumlah = 1;
                                    } elseif ($assoc['jum'] != 0) {
                                        $jumlah = $assoc['jum'];
                                    }
                                    ?>
                                    <div class="form-floating">
                                        <input required type="number" class="form-control" min="<?= $jumlah ?>" id="jumlah" name="jumlah" value="<?= $data['jumlah'] ?>">
                                        <label for="jumlah">Input Lots Of Items</label>
                                    </div>
                                    <h5 class="card-title mb-0 mt-4" class="form-label" for="id_kategori" style="color: #6d6d6d;"><label for="id_kategori" class="form-label" style="font-size: 20px;">*Category Item</label>
                                    </h5>
                                    <div class="form-floating">
                                        <select class="form-select" id="id_kategori" name="id_kategori">

                                            <?php
                                            $kueri = mysqli_query($conn, "SELECT * FROM tb_kategori_barang");
                                            while ($data3 = mysqli_fetch_array($kueri)) {
                                                echo '
                                                <option value="' . $data3["id_kategori"] . '" id="id_kategori" name="id_kategori"';
                                                if ($data["id_kategori"] == $data3["id_kategori"]) {
                                                    echo 'selected';
                                                }
                                                echo '>' . $data3["nama_kategori"] . '</option>';
                                            }
                                            ?>


                                        </select>
                                        <label for="id_kategori">Pilih Category</label>
                                    </div>
                                </div>
                                <h5 class="card-title mb-0 mt-4" class="form-label" for="foto" style="color: #6d6d6d;">
                                    <label for="foto" class="form-label" style="font-size: 20px;">*Image Item</label>
                                </h5>
                                <div class="card mb-0">
                                    <img src="./foto_item/<?= $data['foto'] ?>" alt="" width="80px" height="">
                                </div>

                                <input class="form-control form-control-lg" id="foto" name="foto" type="file">


                            </div>

                    </div>

                    <div class="col-sm-5 row pb-1" style="margin-left: 29%;">
                        <button type="submit" class="btn btn-primary btn-lg" name="input" style="color: white;">Submit</button>
                    </div>
                    <div class="row pb-5" style="text-align: center;">
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>

    </div>
    </div>

    <script src="js/app.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>