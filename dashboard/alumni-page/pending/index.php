<?php
include "../../../function.php";
session_start();

if (!isset($_SESSION['login'])) {
    header('location:../../login/');
    exit;
}

$user_id = $_SESSION['login']['id_user'];

$cart = mysqli_query($conn, "SELECT tb_cart.id_cart, tb_cart.jumlah, tb_cart.id_barang, tb_cart.id_user, tb_inventory.id_barang, tb_inventory.nama_barang, tb_inventory.jumlah as jmlInv FROM tb_cart INNER JOIN tb_inventory ON tb_cart.id_barang = tb_inventory.id_barang WHERE tb_cart.id_user = $user_id");


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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>PENDING| DASHBOARD</title>
    <link href="../../css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">

        <?php include "../../template/sidebar.php" ?>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <?php include "../../template/navbardashboard.php"; ?>
            </nav>

            <main class="content">
            <div class="row">
                            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                                <div class="card flex-fill">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Items In Pending</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                




        </div>
        </main>
    </div>
    </div>


    <script src="../../js/app.js"></script>

    <script>
        let form = document.querySelector('#submit_form');
        let qty = document.getElementsByClassName("qty");

        Array.from(qty).forEach(function(q) {
            q.addEventListener('change', debounce(() => q.form.submit()));
        });

        function debounce(func, timeout = 50) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args)
                }, timeout);
            };
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
            var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
            document.getElementById("datetimepicker-dashboard").flatpickr({
                inline: true,
                prevArrow: "<span title=\"Previous month\">&laquo;</span>",
                nextArrow: "<span title=\"Next month\">&raquo;</span>",
                defaultDate: defaultDate
            });
        });
    </script>

</body>

</html>