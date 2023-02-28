<?php
include "../../function.php";
include "./function/update_pengeluaran.php";
include "./function/session.php";
$total = mysqli_query($conn, 'SELECT SUM(saldo) AS saldo_kas FROM tb_kas_siswa');
$assoc_total = mysqli_fetch_assoc($total);
$p = mysqli_query($conn, "SELECT SUM(saldo) AS saldop FROM tb_kas_keluar");
$assoc_p = mysqli_fetch_assoc($p);
$tot = (int)$assoc_total['saldo_kas'];
$pl = (int)$assoc_p['saldop'];
$pengeluaran = $tot - $pl;

$id_kas = $_GET["id_kas_keluar"];
$data = mysqli_query($conn, "SELECT * FROM tb_kas_keluar WHERE id_kas_keluar = $id_kas");
$datas = mysqli_fetch_assoc($data);

$finalmax = $pengeluaran + (int)$datas['saldo'];

if (isset($_POST['updatep'])) {
    if (updatep($_POST) > 0) {
    } else {
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../template/head.php"; ?>
    <title>Dashboard | Update Pengeluaran</title>
</head>

<body>
    <div class="wrapper">

        <?php include "../template/sidebar.php" ?>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <?php include "../template/navbardashboard.php"; ?>
            </nav>

            <div class="container mt-3">


                <div class="card flex-fill mt-4" style="border-radius: 20px;">
                    <div class="card-header" style="border-radius: 20px;">

                        <h5 class="card-title mb-0">
                            <i class="align-middle" data-feather="plus-square"></i> Update Pengeluaran
                        </h5>
                        <hr>

                        <form method="post" enctype="multipart/form-data">

                            <input type="hidden" value="<?= $finalmax; ?>" name="finalmax">
                            <input type="hidden" value="<?= $id_kas; ?>" name="id_kas">
                            <div class="row g-2">
                                <h5 class="card-title mb-0" class="form-label" for="saldo" style="color: #6d6d6d;">
                                    <label for="saldo" class="form-label" style="font-size: 20px;">*Saldo</label>
                                    <h5>
                                        <div class="form-floating">
                                            <input type="number" class="form-control" min='1' max="<?= $finalmax ?>" id="saldo" name="saldo" value="<?= $datas['saldo'] ?>">
                                            <label for="floatingInputValue">Enter the issued balance</label>
                                        </div>

                                        <h5 class="card-title mb-0 mt-1" class="form-label" for="nota" style="color: #6d6d6d;">
                                            <label for="nota" class="form-label" style="font-size: 20px;">*Nota</label>
                                        </h5>
                                        <img src="./nota/<?= $datas['nota'] ?>" style="width: 200px;">


                                        <div class="mb-3">
                                            <h5 class="card-title mb-0 mt-4" class="form-label" for="deskripsi" style="color: #6d6d6d;">
                                                <label for="deskripsi" class="form-label" style="font-size: 20px;">*Deskripsi</label>
                                            </h5>
                                            <textarea name="deskripsi" id="deskripsi" class="form-control" require><?= $datas['deskripsi'] ?></textarea>
                                        </div>
                            </div>

                            <div class="col-sm-5 row pb-1" style="margin-left: 29%;">
                                <button type="submit" class="btn btn-primary btn-lg" name="updatep" style="color: white;">Input</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>
    </div>

    <script src="../js/app.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
	<!-- <script src="vendor/ckeditor/ckeditor/ckeditor.js"></script>
	<script>
		CKEDITOR.replace('deskripsi', {
			uiColor: "#dbdad9"
		});
	</script> -->
	<script type="text/javascript">
  $(document).ready(function() {
    $('#deskripsi').summernote({
      height: "300px",
      styleWithSpan: false,
      theme: 'monokai'
    });
  }); 
</script>

</body>

</html>