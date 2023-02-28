<?php

include "../../koneksi/conn.php";
include "./function/session.php";
include "./function/update_class.php";

if (isset($_POST['update_class'])) {

    if (update_class($_POST) > 0) {
        
    } else {
        echo mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "../template/head.php" ?>

    <title>Dashboard | Admin</title>

    <script>
		function showAlert(status) {
			 if (status == 'error') {
				Swal.fire({
					position: 'center',
					icon: 'error',
					title: 'Kelas Sudah Terdaftar!',
					showConfirmButton: false,
					timer: 1500
				})
			}
		}
	</script>
</head>

<body>
	<?php if (@$_SESSION['data-success'] == "error") {
	?>
		<script>
			showAlert('error')
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
                            <i class="align-middle" data-feather="edit"></i>Add Class Student
                        </h5>
                        <hr>
                        <?php
                        foreach ($data as $data1) {
                            # code...

                        ?>
                            <form method="post" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" id="id_kelas" name="id_kelas" value="<?= $data1['id_kelas'] ?>">
                                <div class="row g-2">

                                    <h5 class="card-title mb-0" class="form-label" for="nama_kelas" style="color: #6d6d6d;">
                                        <label for="nama_kelas" class="form-label" style="font-size: 20px;">*Nama Kelas</label>
                                    </h5>
                                    <div class="form-floating">
                                        <input required type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Nama Kelas" value="<?= $data1["nama_kelas"] ?>">
                                        <label for="nama_kelas">Nama Kelas </label>
                                    </div>
                                </div>
                                <div class="col-sm-5 row pb-1 mt-3" style="margin-left: 29%;">
                                    <button type="submit" class="btn btn-primary btn-lg" name="update_class" style="color: white;">Update</button>
                                </div>
                            <?php
                        }
                            ?>
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
</body>

</html>